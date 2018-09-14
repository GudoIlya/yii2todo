<?php

namespace app\modules\profile\models;

use Yii;

/**
 * This is the model class for table "services".
 *
 * @property int $id
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
            [['name'], 'required'],
            [['name', 'description'], 'string', 'max' => 255],
            ['name', 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
    public function getUsersServices()
    {
        return $this->hasMany(UsersServices::className(), ['service_id' => 'id']);
    }
}
