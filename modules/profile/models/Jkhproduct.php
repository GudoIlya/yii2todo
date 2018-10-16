<?php
namespace app\modules\profile\models;

use yii\db\ActiveRecord;
use yii\behaviors\BlameableBehavior;
use app\models\UserCustom;

class Jkhproduct extends ActiveRecord{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => BlameableBehavior::className(),
            'createdByAttribute' => 'user_id',
            'updatedByAttribute' => false,
            'attributes' => [
                ActiveRecord::EVENT_BEFORE_VALIDATE => ['user_id']
            ]
        ];
        return $behaviors;
    }

    public static function instantiate($row)
    {
        switch ($row['type']) {
            case JkhService::TYPE:
                return new JkhService();
            case JkhResource::TYPE:
                return new JkhResource();
            default:
                return new self;
        }
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
            [['name', 'type', 'user_id'], 'required'],
            [['standard_value'], 'number'],
            [['standard_value', 'maintanence_end'], 'default', 'value' => null],
            [['maintanence_end'], 'date', 'format' => 'dd.MM.yyyy'],
            [['name'], 'string', 'max' => 200],
            [['description'], 'string', 'max' => 300],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => UserCustom::className(), 'targetAttribute' => ['user_id' => 'id']],
            ['type', function($attribute, $params, $validator) {
                if( !in_array($this->$attribute, array(JkhResource::TYPE, JkhService::TYPE) ) ) {
                    $this->addError($attribute, 'Такого типа продукта не существует');
                }
            }]
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
            'type' => 'Категория',
            'user_id' => 'Идентификатор пользователя'
        ];
    }

    public function getProductTypes() {
        return array(
            JkhResource::TYPE => JkhResource::TYPE_NAME,
            JkhService::TYPE => JkhService::TYPE_NAME
        );
    }

    public function getRate() {
        $query = Rate::find()
            ->innerJoin('estate_product ep', 'ep.rate_id = rate.id AND ep.product_id = '.$this->id);
        return $query;
    }
}