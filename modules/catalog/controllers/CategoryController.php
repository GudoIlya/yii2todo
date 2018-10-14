<?php
/**
 * Created by PhpStorm.
 * User: ilypk
 * Date: 29.09.2018
 * Time: 9:40
 */
namespace app\modules\catalog\controllers;


use Yii;
use yii\web\Controller;

class CategoryController extends Controller
{

    public function actionIndex() {

        return $this->render('index', []);
    }

}