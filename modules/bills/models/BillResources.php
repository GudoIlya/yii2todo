<?php

namespace app\modules\bills\models;

use Yii;

/**
 * This is the model class for table "bill_resources".
 *
 * @property int $id
 * @property int $resource_id
 * @property int $bill_id
 * @property int $rate_id
 * @property double $quantity
 * @property double $summ
 *
 * @property Bills $bill
 * @property Rates $rate
 * @property Resources $resource
 */
class BillResources extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bill_resources';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resource_id', 'bill_id', 'rate_id', 'quantity', 'summ'], 'required'],
            [['resource_id', 'bill_id', 'rate_id'], 'default', 'value' => null],
            [['resource_id', 'bill_id', 'rate_id'], 'integer'],
            [['quantity', 'summ'], 'number'],
            [['bill_id'], 'exist', 'skipOnError' => true, 'targetClass' => Bills::className(), 'targetAttribute' => ['bill_id' => 'id']],
            [['rate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rates::className(), 'targetAttribute' => ['rate_id' => 'id']],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resources::className(), 'targetAttribute' => ['resource_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resource_id' => 'Resource ID',
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
    public function getResource()
    {
        return $this->hasOne(Resources::className(), ['id' => 'resource_id']);
    }
}
