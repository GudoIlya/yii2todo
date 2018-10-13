<?php

namespace app\modules\profile\controllers;

use app\modules\profile\models\bill\BillForm;
use app\modules\profile\models\BillProduct;
use app\modules\profile\models\JkhResource;
use app\modules\profile\models\JkhService;
use Yii;
use yii\base\Model;
use yii\db\Transaction;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;


use app\modules\profile\models\Bill;
use app\modules\profile\models\BillSearch;
use app\modules\profile\models\Estate;


class BillController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['index', 'create', 'preparebill'], 'allow' => true, 'roles' => ['@']],
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
        $userId = $this->findModel(Yii::$app->request->get('id'))->getEstate()->one()->user_id;
        return $userId == Yii::$app->user->id;
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
        $model = new Bill();
        $model->load(Yii::$app->request->get(), '');
        $userEstateModel = new Estate();
        $estateItems = $userEstateModel->getUserEstate();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }

        return $this->render('create', [
            'model' => $model,
            'estateItems' => $estateItems
        ]);
    }

    /**
     * 1. Дожлен быть создан новый счет
     * 2. К счету должны быть сразу добавлены существующие продукты, которые подключены к недвижимости
     * 3. (opt) нужно сделать так, чтобы учитывались предыдущие значения показаний. Для этого надо ссылаться на предыдущий счет
     *
     * @return string|\yii\web\Response
     * @throws BadRequestHttpException
     * @throws \yii\db\Exception
     */
    public function actionPreparebillOld() {
        if(!Yii::$app->request->get('estate_id')){
            return $this->redirect(Yii::$app->homeUrl);
        }
        $billModel = new Bill();
        $billProducts = array();
        $billResources = array();
        $billServices = array();
        $billModel->load(Yii::$app->request->get(), '');
        $estate = $billModel->getEstate()->one();
                // Услуги
        $services = $estate->getEstateProducts(JkhService::TYPE);
        $servicesModels = $services->getModels();
        if($servicesModels) {
            foreach($servicesModels as $i => $serviceModel) {
                $newModel = new BillProduct();
                $newModel->estate_product_id = $serviceModel->id;
                $billServices[] = $newModel;
            }
        }

        // Ресурсы
        $resources = $estate->getEstateProducts(JkhResource::TYPE);
        $resourcesModels = $resources->getModels();
        if($resourcesModels) {
            foreach ($resourcesModels as $i => $resourceModel) {
                $newModel = new BillProduct();
                $newModel->estate_product_id = $resourceModel->id;
                $billResources[] = $newModel;
            }
        }

        if(Yii::$app->request->isPost) {
            $billModel->load(Yii::$app->request->post());

            $billProductsPost = Yii::$app->request->post('BillProduct', []);

            foreach($billProductsPost['services'] as $i => $data) {
                if(!isset($billServices[$i])) {
                    $billServices[$i] = new BillProduct();
                }
                $billServices[$i]->load($data, '');
                $billProducts[] = $billServices[$i];
            }

            foreach($billProductsPost['resources'] as $i => $data) {
                if(!isset($billResources[$i])) {
                    $billResources[$i] = new BillProduct();
                }
                $billResources[$i]->load($data, '');
                $billProducts[] = $billResources[$i];
            }

            $transaction = Yii::$app->db->beginTransaction(
                Transaction::SERIALIZABLE
            );

            try {
                $valid = $billModel->validate();
                if($valid) {
                    $billModel->save(false);
                    foreach ($billProducts as $i => $billProduct) {
                        $billProducts[$i]->bill_id = $billModel->id;
                    }
                    $valid = Model::validateMultiple($billProducts);
                    if($valid) {
                        foreach ($billProducts as $billProduct) {
                            $billProduct->save(false);
                        }
                        $transaction->commit();
                        return $this->redirect(['/profile/bill/view', 'id'=>$billModel->id]);
                    } else {
                        $transaction->rollBack();
                    }
                }
            } catch (\Exception $e) {
                $transaction->rollBack();
                throw new BadRequestHttpException($e->getMessage(), 0, $e);
            }

        }

        return $this->render('prepareBill', [
            'billModel' => $billModel,
            'resourcesModels' => $billResources,
            'servicesModels' => $billServices
        ]);
    }


    public function actionPreparebill() {
        $billForm = new BillForm(['estate_id' => Yii::$app->request->get('estate_id')]);
        if(Yii::$app->request->isPost) {
            $billForm->load(Yii::$app->request->post());
            if($billForm->save()) {
                return $this->redirect('/index');
            }
        }
        return $this->render('prepareBillNew', [
            'billForm' => $billForm
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
        $this->findModel($id)->delete();

        return $this->redirect(['/profile/bill']);
    }

    /**
     * Finds the Estate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bill the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bill::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}