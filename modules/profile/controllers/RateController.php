<?php

namespace app\modules\profile\controllers;

use app\modules\profile\models\JkhproductSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\modules\profile\models\Rate;
use app\modules\profile\models\RateSearch;
use app\modules\profile\models\UsersRates;
use app\modules\profile\models\RateCategories;
use app\modules\profile\models\Jkhproduct;


/**
 * RatesController implements the CRUD actions for Rates model.
 */
class RateController extends Controller
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
                            if( isset(Yii::$app->user->identity) && Yii::$app->user->identity->isAdmin || $this->isRateOwner() ) {
                                return true;
                            }
                            return false;
                      }
                    ],
                    [
                        'actions' => ['update', 'delete'],
                        'allow'   => true,
                        'matchCallback' => function($rule, $action) {
                            if( $this->isRateOwner() ) {
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
    protected function isRateOwner() {
        $jkhproduct = Jkhproduct::find()->where(['user_id' => UserCustom::getUserId(), 'product_id' => Yii::$app->request->get('product_id')]);
        return $jkhproduct->user_id == Yii::$app->user->id;
    }

    /**
     * Lists all Rates models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Rates model.
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
     * Creates a new Rates model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $ratesModel= new Rate();
        $jkhproductsSearchModel = new JkhproductSearch();
        $jkhproducts = $jkhproductsSearchModel->search(Yii::$app->request->queryParams)->getModels();
        $productsItems = ArrayHelper::map($jkhproducts, 'id', 'name');
        $ratesModel->load(Yii::$app->request->get(), '');
        if ( $ratesModel->load(Yii::$app->request->post()) && $ratesModel->save() ) {
            return $this->redirect(['view', 'id' => $ratesModel->id]);
        }

        return $this->render('create', [
            'model' => $ratesModel,
            'productItems' => $productsItems
        ]);
    }

    /**
     * Updates an existing Rates model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $jkhproductsSearchModel = new JkhproductSearch();
        $jkhproducts = $jkhproductsSearchModel->search(Yii::$app->request->queryParams)->getModels();
        $productsItems = ArrayHelper::map($jkhproducts, 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'productItems' => $productsItems
        ]);
    }

    /**
     * Deletes an existing Rates model.
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
     * Finds the Rates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Rate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Rate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
