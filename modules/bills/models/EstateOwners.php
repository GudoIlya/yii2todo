<?php

namespace app\modules\bills\models;

use Yii;
use app\models\UserCustom as User;

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
class EstateOwners extends \yii\db\ActiveRecord
{

    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estate_owners';
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_CREATE] = ['portion'];
        $scenarios[self::SCENARIO_UPDATE] = ['user_id', 'estate_id', 'portion'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'estate_id', 'portion'], 'required'],
            [['user_id', 'estate_id'], 'default', 'value' => null],
            [['user_id', 'estate_id'], 'integer'],
            [['portion'], 'number', 'max' => 1],
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
            'user_id' => 'User ID',
            'estate_id' => 'Estate ID',
            'portion' => 'Доля собственника'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstate()
    {
        return $this->hasOne(Estate::className(), ['id' => 'estate_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
