<?php
/**
 * Created by PhpStorm.
 * User: ilypk
 * Date: 02.10.2018
 * Time: 0:26
 */
namespace app\modules\yandexapi\controllers;

use app\modules\yandexapi\marketapi\reviews\Reviews;
use Codeception\Module\REST;

class ReviewsController extends \yii\web\Controller
{
    public function actionOneReview($id = null) {
        $reviews = new Reviews();
        $opinion = $reviews->getModelReviews(1727685734);
        return $this->render('one', ['opinion' => $opinion]);
    }
}