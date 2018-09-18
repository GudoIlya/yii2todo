<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

use app\modules\profile\models\UsersResources;
use app\modules\profile\models\UsersResourcesSearch;
use app\modules\profile\models\UsersServices;
use app\modules\profile\models\UsersServicesSearch;
use app\models\UserCustom;
use app\modules\profile\models\Estate;
use app\modules\profile\models\EstateProduct;
/**
 * UsersServicesController implements the CRUD actions for UsersServices model.
 */
class EstateproductController extends Controller
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
     * Check if authenticated user is owner of the user resource
     * @return bool
     * @throws NotFoundHttpException
     */
    protected function isUserOwner() {
        return $this->findModel(Yii::$app->request->get('id'))->user_id == Yii::$app->user->id;
    }

    /**
     * Lists all UsersServices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersResourcesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UsersServices model.
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
     * Creates a new UsersServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UsersResources();
        $model->load(Yii::$app->request->get(), '');
        $estateModel = new Estate();
        $resourceItems = $model->getResourceOptions();
        $rateItems = $model->getRatesOptions();
        $userEstatesList = $estateModel->getEstateOptions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'resourceItems' => $resourceItems,
            'rateItems' => $rateItems,
            'estateItems' => $userEstatesList
        ]);
    }

    /**
     * Updates an existing UsersServices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $estateModel = new Estate();
        $resourceItems = $model->getResourceOptions();
        $rateItems = $model->getRatesOptions();
        $estateItems = $estateModel->getEstateOptions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'resourceItems' => $resourceItems,
            'rateItems' => $rateItems,
            'estateItems' => $estateItems
        ]);
    }

    /**
     * Deletes an existing UsersServices model.
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
     * Finds the UsersServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UsersServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EstateProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
