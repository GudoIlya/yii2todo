<?php

namespace app\modules\profile\models;

use Yii;
use yii\data\ActiveDataProvider;
use app\models\UserCustom;
use app\modules\profile\models\UsersServices;
use app\modules\profile\models\UsersResources;
use app\modules\profile\models\Rates;

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
        $scenarios[self::UPDATE_ESTATE] = ['title', 'space'];
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

    public function getEstateOptions() {
        return $this->find()
            ->innerJoin('estate_owners', 'estate_id = estate.id AND user_id = '.UserCustom::getUserId())
            ->select(['title'])
            ->indexBy('id')
            ->column();
    }

    public function getEstateServices() {
        $query =  UsersServices::find()
            ->andWHere('estate_id = '.$this->id)
            ->andWhere('user_id = '.UserCustom::getUserId());

        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

    public function getEstateResources() {
        $query =  UsersResources::find()
            ->andWHere('estate_id = '.$this->id)
            ->andWhere('user_id = '.UserCustom::getUserId());
        return  new ActiveDataProvider([
            'query' => $query,
        ]);
    }

    public function getEstateBills() {
        return true;
    }
}
