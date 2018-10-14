<?php
/**
 * Created by PhpStorm.
 * User: ilypk
 * Date: 29.09.2018
 * Time: 9:58
 */
namespace app\modules\catalog\models;


class Category extends \yii\db\ActiveRecord
{

    public static function tableName() {
        return 'catalog.category';
    }


}