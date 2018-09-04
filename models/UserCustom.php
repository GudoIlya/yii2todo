<?php
namespace app\models;

use \dektrium\user\models\User as BaseUser;

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

}