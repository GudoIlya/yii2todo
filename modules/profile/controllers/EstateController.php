<?php

namespace app\modules\profile\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\bills\models\Estate;
use app\modules\bills\models\EstateSearch;
use app\modules\bills\models\EstateOwners;

/**
 * EstateController implements the CRUD actions for Estate model.
 */
class EstateController extends Controller
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
                    ['allow' => true, 'roles' => ['@']],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Estate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EstateSearch();
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
        $estateModel = new Estate();
        $estateOwners = new EstateOwners();
        $estateModel->scenario = 'create';
        $estateOwners->scenario = 'create';

        if ($estateModel->load(Yii::$app->request->post()) && $estateOwners->load(Yii::$app->request->post())) {
            $isValid = $estateModel->validate();
            $isValid = $estateOwners->validate() && $isValid;
            if($isValid) {
                $estateModel->save(false);
                $estateOwners->user_id = Yii::$app->user->getId();
                $estateOwners->estate_id = $estateModel->id;
                $estateOwners->save(false);
                return $this->redirect(['/profile']);
            }
        }

        return $this->render('create', [
            'estateModel' => $estateModel,
            'estateOwnersModel' => $estateOwners
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
        EstateOwners::find()->where(['estate_id' => $id, 'user_id' => Yii::$app->user->identity->getId()])->one()->delete();

        return $this->redirect(['/profile']);
    }

    /**
     * Finds the Estate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Estate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
