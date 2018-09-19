<?php

namespace app\modules\profile\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use dektrium\user\models\User;

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
class Bill extends ActiveRecord
{

    public $services_summ = 0;
    public $resources_summ = 0;

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
        return 'bill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['billnumber', 'estate_id', 'is_paid', 'date_pay'], 'required'],
            [['estate_id'], 'integer'],
            [['billnumber'], 'string', 'max' => 100],
            [['total'], 'number'],
            ['total', 'default', 'value' => false],
            ['is_paid', 'default', 'value' => 0],
            [['is_paid'], 'boolean'],
            [['date_pay'], 'date'],
            [['billnumber', 'estate_id'], 'unique', 'targetAttribute' => ['billnumber', 'estate_id']],
            [['estate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estate::className(), 'targetAttribute' => ['estate_id' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'billnumber' => 'Номер счета',
            'total' => 'Конечная сумма',
            'is_paid' => 'Оплачен ли?',
            'estate_id' => 'Недвижимость',
            'date_pay' => 'Оплатить до'
        ];
    }

    public function getEstate() {
        return $this->hasOne(Estate::className(), ['id' => 'estate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillProducts()
    {
        return $this->hasMany(BillProduct::className(), ['bill_id' => 'id']);
    }

    public function getBillProductsDP($products_type) {
        $query = $this->getBillProducts()->alias('bp')
            ->innerJoin('estate_product ep', 'ep.id = bp.estate_product_id')
            ->innerJoin('jkh_product jp', 'jp.id = ep.product_id AND jp.type = \''.$products_type.'\'');
        return new ActiveDataProvider(['query' => $query]);
    }

}
