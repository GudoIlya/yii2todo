<?php

namespace app\modules\bills\models;

use Yii;
use dektrium\user\models\User;

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
class UsersServices extends \yii\db\ActiveRecord
{
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
            [['service_id', 'user_id', 'date_create'], 'required'],
            [['service_id', 'user_id'], 'default', 'value' => null],
            [['service_id', 'user_id'], 'integer'],
            [['date_create'], 'safe'],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['service_id' => 'id']],
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
            'service_id' => 'Service ID',
            'user_id' => 'User ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
