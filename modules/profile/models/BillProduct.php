<?php

namespace app\modules\profile\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "bill_services".
 *
 * @property int $id
 * @property int $bill_id
 * @property int $estate_product_id
 * @property int $rate_id
 * @property double $quantity
 *
 * @property Bill $bill
 * @property Rate $rate
 * @property Services $service
 */
class BillProduct extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill_product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bill_id', 'estate_product_id', 'rate_id', 'quantity', 'current_counter_value'], 'required'],
            [['bill_id', 'estate_product_id', 'rate_id'], 'integer'],
            [['quantity'], 'number'],
            [['bill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bill::className(), 'targetAttribute' => ['bill_id' => 'id']],
            [['rate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rate::className(), 'targetAttribute' => ['rate_id' => 'id']],
            [['estate_product_id'], 'exist', 'skipOnError' => true, 'targetClass' => EstateProduct::className(), 'targetAttribute' => ['estate_product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_id' => 'Счет',
            'rate_id' => 'Тариф',
            'estate_product_id' => 'Товар',
            'quantity' => 'Quantity',
            'total' => 'Итог',
            'current_counter_value' => 'Значение счетчика'
        ];
    }

    public function beforeValidate()
    {
        $this->rate_id = $this->getEstateProduct()->one()->rate_id;
        return parent::beforeValidate(); // TODO: Change the autogenerated stub
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBill()
    {
        return $this->hasOne(Bill::className(), ['id' => 'bill_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRate()
    {
        return $this->hasOne(Rate::className(), ['id' => 'rate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstateProduct()
    {
        return $this->hasOne(EstateProduct::className(), ['id' => 'estate_product_id']);
    }
}
