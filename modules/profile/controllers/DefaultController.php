<?php

namespace app\modules\profile\controllers;

use Yii;
use app\modules\profile\models\EstateSearch;
use app\modules\profile\models\Jkhproduct;
use app\modules\profile\models\JkhResource;
use yii\web\Controller;
use yii\filters\AccessControl;
use dektrium\user\controllers\ProfileController;

/**
 * Default controller for the `profile` module
 */
class DefaultController extends ProfileController
{

    public function behaviors()
    {
        return [
            'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        ['allow' => true, 'roles' => ['@']],
                    ],
                ],
            ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        parent::actionIndex();
    }

    public function actionShow($id)
    {

        $profile = $this->finder->findProfileById($id);
        $userModel = $this->finder->findUserById($id);

        $userEstateSearchModel = new EstateSearch();
        $userEstatesModel = $userEstateSearchModel->search(Yii::$app->request->queryParams);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'profile' => $profile,
            'userEstatesModel' => $userEstatesModel,
            'userEstateSearchModel' => $userEstateSearchModel
        ]);
    }
}
