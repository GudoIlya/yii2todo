<?php

namespace app\models;

use Yii;

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
            [['name', 'price', 'category_id', 'date_create'], 'required'],
            [['price'], 'number'],
            [['category_id'], 'default', 'value' => null],
            [['category_id'], 'integer'],
            [['date_create'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
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
            'name' => 'Name',
            'price' => 'Price',
            'category_id' => 'Category ID',
            'date_create' => 'Date Create',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResources()
    {
        return $this->hasMany(Resources::className(), ['current_rate' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Services::className(), ['current_rate' => 'id']);
    }
}
