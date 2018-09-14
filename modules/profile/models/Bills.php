<?php

namespace app\modules\profile\models;

use Yii;

/**
 * This is the model class for table "bills".
 *
 * @property int $id
 * @property string $bill-number
 * @property string $date
 * @property double $services_summ
 * @property double $resources_summ
 * @property bool $is_paid
 *
 * @property BillResources[] $billResources
 * @property BillServices[] $billServices
 */
class Bills extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bills';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bill-number', 'date', 'services_summ', 'resources_summ'], 'required'],
            [['date'], 'safe'],
            [['services_summ', 'resources_summ'], 'number'],
            [['is_paid'], 'boolean'],
            [['bill-number'], 'string', 'max' => 255],
            [['bill-number'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill-number' => 'Bill Number',
            'date' => 'Date',
            'services_summ' => 'Services Summ',
            'resources_summ' => 'Resources Summ',
            'is_paid' => 'Is Paid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillResources()
    {
        return $this->hasMany(BillResources::className(), ['bill_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillServices()
    {
        return $this->hasMany(BillServices::className(), ['bill_id' => 'id']);
    }
}
