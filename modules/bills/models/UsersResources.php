<?php

namespace app\modules\bills\models;

use Yii;
use dektrium\user\models\User;

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
class UsersResources extends \yii\db\ActiveRecord
{
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
            [['resource_id', 'user_id', 'date_create'], 'required'],
            [['resource_id', 'user_id'], 'default', 'value' => null],
            [['resource_id', 'user_id'], 'integer'],
            [['date_create'], 'safe'],
            [['resource_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resources::className(), 'targetAttribute' => ['resource_id' => 'id']],
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
            'resource_id' => 'Resource ID',
            'user_id' => 'User ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
