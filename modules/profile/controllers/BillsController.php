<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;


use app\modules\profile\models\Bills;
use app\modules\profile\models\BillsSearch;
use app\modules\profile\models\Estate;


class BillsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['index', 'create'], 'allow' => true, 'roles' => ['@']],
                    [
                        'actions' => ['view'],
                        'allow'  => true,
                        'matchCallback' => function($rule, $action) {
                            if( isset(Yii::$app->user->identity) && Yii::$app->user->identity->isAdmin || $this->isUserOwner() ) {
                                return true;
                            }
                            return false;
                        }
                    ],
                    [
                        'actions' => ['update', 'delete'],
                        'allow'   => true,
                        'matchCallback' => function($rule, $action) {
                            if( $this->isUserOwner() ) {
                                return true;
                            }
                            return false;
                        }
                    ]
                ],
            ],
        ];
    }

    /**
     * Check if authenticated user is owner of the rate
     * @return bool
     * @throws NotFoundHttpException
     */
    protected function isUserOwner() {
        return $this->findModel(Yii::$app->request->get('id'))->user_id == Yii::$app->user->id;
    }


    /**
     * Lists all Estate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estate model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Estate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bills();
        $model->load(Yii::$app->request->get(), '');
        $userEstateModel = new Estate();
        $estateItems = $userEstateModel->getEstateOptions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/profile']);
        }

        return $this->render('create', [
            'model' => $model,
            'estateItems' => $estateItems
        ]);
    }

    /**
     * Updates an existing Estate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $estateModel = $this->findModel($id);
        $estateOwnersModel = EstateOwners::find()->where(['estate_id' => $estateModel->id, 'user_id' => Yii::$app->user->identity->getId()])->one();
        $estateModel->scenario = 'update';
        $estateOwnersModel->scenario = 'update';
        if ($estateModel->load(Yii::$app->request->post()) && $estateOwnersModel->load(Yii::$app->request->post())) {
            $isValid = $estateModel->validate();
            $isValid = $estateOwnersModel->validate() && $isValid;
            if($isValid) {
                $estateModel->save(false);
                $estateOwnersModel->save(false);
                return $this->redirect(['view', 'id' => $estateModel->id]);
            }
        }

        return $this->render('update', [
            'estateModel' => $estateModel,
            'estateOwnersModel' => $estateOwnersModel
        ]);
    }

    /**
     * Deletes an existing Estate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/profile/bills']);
    }

    /**
     * Finds the Estate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bills the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bills::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}