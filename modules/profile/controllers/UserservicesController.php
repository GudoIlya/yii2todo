<?php

namespace app\modules\profile\controllers;


use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

use app\modules\profile\models\ServicesSearch;
use app\modules\profile\models\Rate;
use app\modules\profile\models\Services;
use app\modules\profile\models\UsersServices;
use app\modules\profile\models\UsersServicesSearch;
use app\modules\profile\models\Estate;


/**
 * ServicesController implements the CRUD actions for Services model.
 */
class UserservicesController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
     * Check if authenticated user is owner of the userservice
     * @return bool
     * @throws NotFoundHttpException
     */
    protected function isUserOwner() {
        return $this->findModel(Yii::$app->request->get('id'))->user_id == Yii::$app->user->id;
    }

    /**
     * Lists all Services models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Services model.
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
     * Creates a new Services model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $userServicesModel = new UsersServices();
        $userServicesModel->load(Yii::$app->request->get(),'');
        $userEstateModel = new Estate();
        $servicesItems = Services::find()
            ->select(['name'])
            ->indexBy('id')
            ->column();
        $ratesItems = $userServicesModel->getRatesOptions();
        $estateItems = $userEstateModel->getEstateOptions();

        if ($userServicesModel->load(Yii::$app->request->post()) && $userServicesModel->save()) {
            return $this->redirect(['view', 'id' => $userServicesModel->id]);
        }

        return $this->render('create', [
            'servicesItems' => $servicesItems,
            'ratesItems' => $ratesItems,
            'userServicesModel' => $userServicesModel,
            'estateItems' => $estateItems
        ]);
    }


    /**
     * Updates an existing Services model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $estateModel = new Estate();
        $model = $this->findModel($id);
        $servicesItems = Services::find()
            ->select(['name'])
            ->indexBy('id')
            ->column();
        $ratesItems = $model->getRatesOptions();
        $estateItems = $estateModel->getEstateOptions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'servicesItems' => $servicesItems,
            'ratesItems' => $ratesItems,
            'estateItems' => $estateItems
        ]);
    }

    /**
     * Deletes an existing Services model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Services model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Services the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UsersServices::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
