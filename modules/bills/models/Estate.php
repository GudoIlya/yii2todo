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

    const CREATE_ESTATE = 'create';
    const UPDATE_ESTATE = 'update';

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::CREATE_ESTATE] = ['title', 'space'];
        return $scenarios;
    }

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
            'title' => 'Наименование недвижимости',
            'space' => 'Площадь',
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
