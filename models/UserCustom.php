<?php
namespace app\models;

use Yii;
use \dektrium\user\models\User as BaseUser;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

use app\modules\profile\models\Estate;
use app\modules\profile\models\Rates;
use app\modules\profile\models\EstateProduct;

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
        return $this->hasMany(Estate::className(), ['user_id' => 'id']);
    }

    public function getEstatesDataProvider($params = false) {
        $dp = $this->getDataProviderByQuery($this->getEstates());
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