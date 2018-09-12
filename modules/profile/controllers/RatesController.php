<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use app\modules\bills\models\Rates;
use app\modules\bills\models\RatesSearch;
use app\modules\bills\models\UsersRates;
use app\modules\bills\models\RateCategories;
use app\modules\bills\controllers\RatesController as RatesControllerBase;

/**
 * RatesController implements the CRUD actions for Rates model.
 */
class RatesController extends RatesControllerBase
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['index', 'create'], 'allow' => true, 'roles' => ['@']],
                    [
                      'action' => ['view'],
                      'allow'  => true,
                      'matchCallback' => function($rule, $action) {
                            if( Yii::$app->user->identity->isAdmin || $this->isRateOwner() ) {
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
        return $this->findModel(Yii::$app->request->get('id'))->user_id == Yii::$app->user->id;
    }

    /**
     * Lists all Rates models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RatesSearch();
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
        $ratesModel= new Rates();
        $rateCategoriesItems = RateCategories::find()
            ->select(['name'])
            ->indexBy('id')
            ->column();
        if ( $ratesModel->load(Yii::$app->request->post()) && $ratesModel->save() ) {
            return $this->redirect(['view', 'id' => $ratesModel->id]);
        }

        return $this->render('create', [
            'model' => $ratesModel,
            'rateCategoriesItems' => $rateCategoriesItems
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
        $rateCategoriesItems = RateCategories::find()
            ->select(['name'])
            ->indexBy('id')
            ->column();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'rateCategoriesItems' => $rateCategoriesItems
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

}
