<?php
namespace app\modules\profile\models;

use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

class EstateProduct extends ActiveRecord {

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'date_create',
            'updatedAtAttribute' => false,
            'value' => function(){ return date('d.m.y'); },
        ];
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estate_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estate_id', 'product_id', 'rate_id'], 'required'],
            [['estate_id', 'product_id', 'rate_id'], 'integer'],
            [['default_value'], 'string'], // Пока что строка
            [['estate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estate::className(), 'targetAttribute' => ['estate_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jkhproduct::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['rate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rate::classname(), 'targetAttribute' => ['rate_id' => 'id']],
            [['estate_id', 'product_id'], 'unique', 'targetAttribute' => ['estate_id', 'product_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estate_id' => 'Недвижимость',
            'product_id' => 'Товар',
            'rate_id' => 'Тариф',
            'default_value' => 'Норматив'
        ];
    }

}