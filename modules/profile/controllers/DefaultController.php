<?php

namespace app\modules\profile\controllers;

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
        $userEstatesDP = $userModel->getEstates();
        $userRatesDP = $userModel->getRates();
        $userServicesDP = $userModel->getUserServices();
        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'profile' => $profile,
            'userEstatesDP' => $userEstatesDP,
            'userRatesDP' => $userRatesDP,
            'userServicesDP' => $userServicesDP
        ]);
    }
}
