<?php

namespace app\modules\profile\controllers;

use yii\web\Controller;
use dektrium\user\controllers\ProfileController;

/**
 * Default controller for the `profile` module
 */
class DefaultController extends ProfileController
{
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
        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'profile' => $profile,
            'userEstatesDP' => $userEstatesDP
        ]);
    }
}
