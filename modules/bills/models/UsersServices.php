<?php

namespace app\modules\bills\models;

use Yii;
use dektrium\user\models\User;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;
use app\modules\bills\models\Rates;

/**
 * This is the model class for table "users_services".
 *
 * @property int $id
 * @property int $service_id
 * @property int $user_id
 * @property string $date_create
 *
 * @property Services $service
 * @property User $user
 */
class UsersServices extends ActiveRecord
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
        return 'users_services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'current_rate'], 'required'],
            [['service_id', 'user_id', 'current_rate'], 'default', 'value' => null],
            [['service_id', 'user_id', 'current_rate'], 'integer'],
            [['service_id','user_id'],'unique', 'targetAttribute' => ['user_id', 'service_id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['service_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['current_rate'], 'exist', 'skipOnError' => true, 'targetClass' => Rates::className(), 'targetAttribute' => ['current_rate' => 'id']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Услуга',
            'user_id' => 'User ID',
            'current_rate' => 'Тариф',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }

    public function getRate() {
        return $this->hasOne(Rates::className(), ['id' => 'current_rate']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    // TODO: надо каким-то образом переделать этот момент и изменить тип тарифа на статичный, либо что-то еще
    public function getRatesOptions() {
        return Rates::find()->where(['user_id' => Yii::$app->user->identity->getId(), 'category_id' => 1])->select(['concat(name,\', ценой \', price) as name'])->indexBy('id')->column();
    }
}
