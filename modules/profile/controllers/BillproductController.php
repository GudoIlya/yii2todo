<?php

namespace app\modules\profile\controllers;

use app\modules\profile\models\EstateProduct;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;


use app\modules\profile\models\Bill;
use app\modules\profile\models\BillSearch;
use app\modules\profile\models\BillProduct;
use app\modules\profile\models\Estate;


class BillproductController extends Controller
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
        $estateOwnerId = $this->findModel(Yii::$app->request->get('id'))->getBill()->one()->getEstate()->one()->user_id;
        return $estateOwnerId == Yii::$app->user->id;
    }


    /**
     * Lists all Estate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillSearch();
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
        $model = new BillProduct();
        $model->load(Yii::$app->request->get(), '');
        $productItems = Bill::findOne($model->bill_id)->getEstate()->one()->getEstateProductOptions(Yii::$app->request->get('type'));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/profile/bill/view', 'id' => $model->bill_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'productItems' => $productItems
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
        $model = $this->findModel($id);
        $model->load(Yii::$app->request->get(), '');
        $userEstateModel = new Estate();
        $estateItems = $userEstateModel->getUserEstate();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'estateItems' => $estateItems
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
        $billproduct = $this->findModel($id);
        $bill_id = $billproduct->bill_id;
        $billproduct->delete();

        return $this->redirect(['/profile/bill/view', 'id' => $bill_id]);
    }

    /**
     * Finds the Estate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BillProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BillProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}