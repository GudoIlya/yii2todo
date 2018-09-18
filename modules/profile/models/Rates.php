<?php

namespace app\modules\profile\models;

use app\models\UserCustom;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\modules\profile\models;

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
class Rates extends ActiveRecord
{

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
        return 'rate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['name', 'product_id', 'price', 'unit'], 'required'],
            [['name', 'price', 'unit', 'date_create'], 'safe'],
            [['price'], 'number'],
            [['unit'], 'string', 'max' => 100],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Jkhproduct::className(), 'targetAttribute' => ['product_id' => 'id']]
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
            'unit' => 'Единица измерения',
            'date_create' => 'Дата создания',
            'product_id' => 'ID товара жкх'
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


    public function getUser() {
        return $this->hasOne(UserCustom::className(), ['id' => 'user_id']);
    }

}
