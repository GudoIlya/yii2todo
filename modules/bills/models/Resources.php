<?php

namespace app\modules\bills\models;

use Yii;

/**
 * This is the model class for table "resources".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $current_rate
 *
 * @property BillResources[] $billResources
 * @property Rates $currentRate
 * @property UsersResources[] $usersResources
 */
class Resources extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resources';
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
            'name' => 'Наименование ресурса',
            'description' => 'Описание'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBillResources()
    {
        return $this->hasMany(BillResources::className(), ['resource_id' => 'id']);
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
    public function getUsersResources()
    {
        return $this->hasMany(UsersResources::className(), ['resource_id' => 'id']);
    }
}
