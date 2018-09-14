<?php

namespace app\modules\profile\models;

use Yii;

/**
 * This is the model class for table "bill_services".
 *
 * @property int $id
 * @property int $service_id
 * @property int $bill_id
 * @property int $rate_id
 * @property double $quantity
 * @property double $summ
 *
 * @property Bills $bill
 * @property Rates $rate
 * @property Services $service
 */
class BillServices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'bill_id', 'rate_id', 'quantity', 'summ'], 'required'],
            [['service_id', 'bill_id', 'rate_id'], 'default', 'value' => null],
            [['service_id', 'bill_id', 'rate_id'], 'integer'],
            [['quantity', 'summ'], 'number'],
            [['bill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bills::className(), 'targetAttribute' => ['bill_id' => 'id']],
            [['rate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rates::className(), 'targetAttribute' => ['rate_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'bill_id' => 'Bill ID',
            'rate_id' => 'Rate ID',
            'quantity' => 'Quantity',
            'summ' => 'Summ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBill()
    {
        return $this->hasOne(Bills::className(), ['id' => 'bill_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRate()
    {
        return $this->hasOne(Rates::className(), ['id' => 'rate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }
}
