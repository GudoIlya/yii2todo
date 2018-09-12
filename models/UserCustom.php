<?php
namespace app\models;

use \dektrium\user\models\User as BaseUser;
use yii\data\ActiveDataProvider;
use app\modules\bills\models\Estate;
use app\modules\bills\models\Rates;

class UserCustom extends BaseUser{

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'][] = 'telephone';
        $scenarios['update'][] = 'telephone';
        $scenarios['register'][] = 'telephone';
        return $scenarios;
    }

    public function rules() {
        $rules = parent::rules();
        $rules['telephoneLegth'] = ['telephone', 'string', 'max' => 11];
        return $rules;
    }

    /**
     * Получить недвижимость пользователя
     */
    public function getEstates() {
        $query = $this->hasMany(Estate::className(), ['id' => 'estate_id'])->viaTable('estate_owners', ['user_id' => 'id']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ]
        ]);
        return $dataProvider;
    }

    /**
     * Получить тарифы пользователя
     */
    public function getRates() {
        $query = $this->hasMany(Rates::className(), ['user_id' => 'id']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);
        return $dataProvider;
    }
}