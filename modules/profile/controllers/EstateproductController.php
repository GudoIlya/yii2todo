<?php

namespace app\modules\profile\controllers;

use app\modules\profile\models\JkhproductSearch;
use app\modules\profile\models\RateSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

use app\models\UserCustom;
use app\modules\profile\models\Estate;
use app\modules\profile\models\EstateProduct;
use app\modules\profile\models\EstateProductSearch;
use app\modules\profile\models\Jkhproduct;

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
                            if( isset(Yii::$app->user->identity) && Yii::$app->user->identity->isAdmin || ($this->isProductOwner() && $this->isEstateOwner()) ) {
                                return true;
                            }
                            return false;
                        }
                    ],
                    [
                        'actions' => ['update', 'delete'],
                        'allow'   => true,
                        'matchCallback' => function($rule, $action) {
                            if( $this->isProductOwner() && $this->isEstateOwner() ) {
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
    protected function isProductOwner() {
        $estateProductModel = $this->findModel(Yii::$app->request->get('id'));
        $jkhProductModel = Jkhproduct::findOne($estateProductModel->product_id);
        return $jkhProductModel->user_id == Yii::$app->user->id;
    }

    protected function isEstateOwner() {
        $estateProductModel = $this->findModel(Yii::$app->request->get('id'));
        $estateModel = Estate::findOne($estateProductModel->estate_id);
        return $estateModel->user_id == Yii::$app->user->id;
    }
    /**
     * Lists all UsersServices models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstateProductSearch();
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
        $model = new EstateProduct();
        $model->load(Yii::$app->request->get(), '');

        $estateModel = new Estate();
        $estateItems = $estateModel->getUserEstate();
        $jkhProductSearch = new JkhproductSearch();
        $productItems = ArrayHelper::map($jkhProductSearch->getJkhProductModels()->getModels(), 'id', 'name');
        $rateItemsModel = new RateSearch();
        $rateItems = ArrayHelper::map($rateItemsModel->getRatesModels()->getModels(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/profile/estate/view', 'id' => $model->estate_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'estateItems' => $estateItems,
            'productItems' => $productItems,
            'rateItems' => $rateItems
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
        $estateItems = $estateModel->getUserEstate();
        $jkhProductSearch = new JkhproductSearch();
        $productItems = ArrayHelper::map($jkhProductSearch->getJkhProductModels()->getModels(), 'id', 'name');
        $rateItemsModel = new RateSearch();
        $rateItems = ArrayHelper::map($rateItemsModel->getRatesModels()->getModels(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'estateItems' => $estateItems,
            'productItems' => $productItems,
            'rateItems' => $rateItems
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
