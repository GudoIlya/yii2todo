<?php

namespace app\modules\bills\models;

use app\models\UserCustom;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "rates".
 *
 * @property int $id
 * @property string $name
 * @property double $price
 * @property int $category_id
 * @property string $date_create
 *
 * @property BillResources[] $billResources
 * @property BillServices[] $billServices
 * @property RateCategories $category
 * @property Resources[] $resources
 * @property Services[] $services
 */
class Rates extends \yii\db\ActiveRecord
{

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'date_create',
            'updatedAtAttribute' => false,
            'value' => function(){ return date('m.d.y'); },
        ];
        $behaviors[] = [
            'class' => BlameableBehavior::className(),
            'createdByAttribute' => 'user_id',
            'updatedByAttribute' => false,
            'attributes' => [
                ActiveRecord::EVENT_AFTER_VALIDATE => ['user_id']
            ]
        ];
        return $behaviors;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price', 'category_id'], 'required'],
            [['price'], 'number'],
            [['category_id'], 'default', 'value' => null],
            [['category_id'], 'integer'],
            [['name', 'price', 'category_id'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name', 'user_id'], 'unique', 'targetAttribute' => ['name', 'user_id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => RateCategories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование тарифа',
            'price' => 'Цена',
            'category_id' => 'Категория тарифа',
            'date_create' => 'Дата создания',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillResources()
    {
        return $this->hasMany(BillResources::className(), ['rate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillServices()
    {
        return $this->hasMany(BillServices::className(), ['rate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(RateCategories::className(), ['id' => 'category_id']);
    }

    public function getUser() {
        return $this->hasOne(UserCustom::className(), ['id' => 'user_id']);
    }

}
