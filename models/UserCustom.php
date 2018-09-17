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
    public function getEstates($params = false) {
        $query = $this->hasMany(Estate::className(), ['user_id' => 'id']);
        return $this->getDataProviderByQuery($query, $params);
    }


    public function getRates($params = false) {
        $query = $this->hasMany(Estate::className(), ['user_id' => 'id']);
        return $this->getDataProviderByQuery($query, $params);
    }

    public function getUserServices($params = false) {
        $query = $this->hasMany(Estate::className(), ['user_id' => 'id']);
        return $this->getDataProviderByQuery($query, $params);
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