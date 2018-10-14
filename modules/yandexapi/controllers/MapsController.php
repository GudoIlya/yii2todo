<?php
/**
 * Created by PhpStorm.
 * User: ilypk
 * Date: 01.10.2018
 * Time: 23:28
 */
namespace app\modules\yandexapi\controllers;

use Yii;
use yii\web\Controller;

class MapsController extends Controller
{


    public function actionToken(){

        return $this->render('point', ['r' => '12']);
    }
}