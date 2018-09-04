<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\web\Controller;
use app\models\RateCategories;
use app\models\RateCategoriesSearch;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $rateCategoriesModel = new RateCategories();
        $rateCategoriesSearchModel = new RateCategoriesSearch();
        $rateCategoriesDataProvider = $rateCategoriesSearchModel->search(Yii::$app->request->queryParams);
        return $this->render('index',[
            'rateCategoriesModel' => $rateCategoriesModel,
            'rateCategoriesDataProvider' => $rateCategoriesDataProvider,
            'rateCategoriesSearchModel' => $rateCategoriesSearchModel
        ]);
    }
}
