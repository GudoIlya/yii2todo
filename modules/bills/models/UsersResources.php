<?php

namespace app\modules\bills\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use dektrium\user\models\User;
use app\modules\bills\models\Rates;

/**
 * This is the model class for table "users_resources".
 *
 * @property int $id
 * @property int $resource_id
 * @property int $user_id
 * @property string $date_create
 *
 * @property Resources $resource
 * @property User $user
 */
class UsersResources extends ActiveRecord
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
        return 'users_resources';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['resource_id', 'current_rate'], 'required'],
            [['resource_id', 'user_id'], 'default', 'value' => null],
            [['resource_id', 'user_id'], 'integer'],
            [['resource_id','user_id'],'unique', 'targetAttribute' => ['user_id', 'resource_id']],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resources::className(), 'targetAttribute' => ['resource_id' => 'id']],
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
            'resource_id' => 'Ресурс',
            'user_id' => 'User ID',
            'current_rate' => 'Действующий тариф',
            'date_create' => 'Date Create',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResource()
    {
        return $this->hasOne(Resources::className(), ['id' => 'resource_id']);
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

    public function getResourceOptions() {
        return Resources::find()->select(['name'])->indexBy('id')->column();
    }

    public function getRatesOptions() {
        return Rates::find()->where(['user_id' => Yii::$app->user->identity->getId(), 'category_id' => 3])->select(['concat(name,\', ценой \', price) as name'])->indexBy('id')->column();
    }
}
