<?php

namespace app\modules\bills\models;

use Yii;

/**
 * This is the model class for table "rate_categories".
 *
 * @property int $id
 * @property string $name
 *
 * @property Rates[] $rates
 */
class RateCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rate_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование категории тарифа',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRates()
    {
        return $this->hasMany(Rates::className(), ['category_id' => 'id']);
    }
}
