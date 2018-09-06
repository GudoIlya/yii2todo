<?php

namespace app\modules\bills\models;

use Yii;

/**
 * This is the model class for table "estate".
 *
 * @property int $id
 * @property string $title
 * @property int $space
 *
 * @property EstateOwners[] $estateOwners
 */
class Estate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estate';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'space'], 'required'],
            [['space'], 'default', 'value' => null],
            [['space'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'space' => 'Space',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstateOwners()
    {
        return $this->hasMany(EstateOwners::className(), ['estate_id' => 'id']);
    }
}
