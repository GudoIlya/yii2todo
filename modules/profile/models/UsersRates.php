<?php

namespace app\modules\profile\models;

use Yii;
use app\models\UserCustom as User;
use app\modules\profile\models\Rate;

/**
 * This is the model class for table "estate_owners".
 *
 * @property int $id
 * @property int $user_id
 * @property int $estate_id
 * @property double $portion
 *
 * @property Estate $estate
 * @property User $user
 */
class UsersRates extends \yii\db\ActiveRecord
{

    const SCENARIO_CREATE = 'create';
    const SCENARIO_DELETE = 'delete';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_rates';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['rate_id', 'user_id'];
        $scenarios[self::SCENARIO_DELETE] = ['rate_id', 'user_id'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'rate_id'], 'required'],
            [['user_id', 'rate_id'], 'default', 'value' => null],
            [['user_id', 'rate_id'], 'integer'],
            [['rate_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rate::className(), 'targetAttribute' => ['rate_id' => 'id']],
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
            'user_id' => 'User ID',
            'rate_id' => 'Rate ID',
        ];
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
