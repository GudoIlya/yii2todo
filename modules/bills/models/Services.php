<?php

namespace app\modules\bills\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property int $current_rate
 * @property string $name
 * @property string $description
 *
 * @property BillServices[] $billServices
 * @property Rates $currentRate
 * @property UsersServices[] $usersServices
 */
class Services extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['current_rate', 'name'], 'required'],
            [['current_rate'], 'default', 'value' => null],
            [['current_rate'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
            [['current_rate'], 'exist', 'skipOnError' => true, 'targetClass' => Rates::className(), 'targetAttribute' => ['current_rate' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'current_rate' => 'Current Rate',
            'name' => 'Name',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillServices()
    {
        return $this->hasMany(BillServices::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentRate()
    {
        return $this->hasOne(Rates::className(), ['id' => 'current_rate']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersServices()
    {
        return $this->hasMany(UsersServices::className(), ['service_id' => 'id']);
    }
}
