<?php

namespace app\modules\profile\models;

use Yii;
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
class Bills extends ActiveRecord
{

    public $services_summ = 0;
    public $resources_summ = 0;

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors[] = [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'date',
            'updatedAtAttribute' => false,
            'value' => function(){ return date('d.m.y'); },
        ];
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
            [['bill_number', 'date', 'services_summ', 'resources_summ', 'user_id', 'estate_id'], 'required'],
            [['date'], 'safe'],
            [['user_id', 'estate_id'], 'integer'],
            [['services_summ', 'resources_summ'], 'number'],
            [['is_paid'], 'boolean'],
            [['bill_number'], 'string', 'max' => 255],
            [['bill_number', 'user_id', 'estate_id'], 'unique', 'targetAttribute' => ['bill-number', 'user_id', 'estate_id']],
            [['estate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estate::className(), 'targetAttribute' => ['estate_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bill_number' => 'Номер счета',
            'date' => 'Дата создания',
            'services_summ' => 'Сумма услуг',
            'resources_summ' => 'Сумма ресурсов',
            'is_paid' => 'Оплачен ли?',
            'user_id' => 'Пользователь',
            'estate_id' => 'Недвижимость'
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
