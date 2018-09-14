<?php
namespace app\models;

use Yii;
use \dektrium\user\models\User as BaseUser;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

use app\modules\bills\models\Estate;
use app\modules\bills\models\Rates;
use app\modules\bills\models\Services;
use app\modules\bills\models\UsersServices;

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
        return $this->getDataProviderByQuery($query);
    }

    /**
     * Get DP for services owned by user
     */
    public function getUserServices() {
        $query = $this->hasMany(UsersServices::className(), ['user_id' => 'id']);
        return $this->getDataProviderByQuery($query);
    }

    /**
     * Получить тарифы пользователя dp
     */
    public function getRates() {
        $query = $this->hasMany(Rates::className(), ['user_id' => 'id']);
        return $this->getDataProviderByQuery($query);
    }

    public function getUserRates() {
        return $this->hasMany(Rates::className(), ['user_id' => 'id']);
    }

    public function getDataProviderByQuery($query, $params = false) {
        $dpConfig = [
            'query' => $query
        ];
        if($params == false) {
            $dpConfig['pagination'] = [
                'pageSize' => 20
            ];
        }
        return new ActiveDataProvider($dpConfig);
    }

    public static function getUserId() {
        return Yii::$app->user->identity->getId();
    }

    public static function getUser() {
        $loggedInUser = Yii::$app->user->identity;
        return $loggedInUser;
    }
}