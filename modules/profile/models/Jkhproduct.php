<?php
namespace app\modules\profile\models;

use yii\db\ActiveRecord;

class Jkhproduct extends ActiveRecord{
    const servicesId = 0;
    const resourcesId = 1;
    private static $productTypes = array(
        self::servicesId => array(
            'name' => 'Услуги'
        ),
        self::resourcesId => array(
            'name' => 'Ресурсы'
        )
    );

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jkh_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'product_type'], 'required'],
            [['name'], 'string', ['maxlength' => 200]],
            ['product_type', function($attribute, $params, $validator) {
                if( !in_array($this->$attribute, $this->productTypes) ) {
                    $this->addError($attribute, 'Такого типа продукта не существует');
                }
            }],
            [['description'], 'string', ['maxlength' => 300]]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'description' => 'Описание',
            'product_type' => 'Категория'
        ];
    }

    public static function getProductTypes() {
        return self::productTypes;
    }

}