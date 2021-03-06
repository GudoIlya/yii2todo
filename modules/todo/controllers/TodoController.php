<?php
namespace app\modules\todo\controllers;

use Yii;
use app\modules\todo\models\task\Task;
use app\modules\todo\Searches\TaskSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class TodoController extends Controller
{

    public function behaviors()
    {
            return[
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        ['actions' => ['index', 'create', 'update', 'view', 'delete'], 'allow' => true, 'roles' => ['@']],
                        [
                            'actions' => ['update', 'view', 'delete'],
                            'allow' => true,
                            'matchCallback' => function($rule, $action) {
                                if( isset(Yii::$app->user->identity) && $this->isUserOwner() ) {
                                    return true;
                                }
                                return false;
                            }
                        ]
                    ]
                ]
            ];
    }


    /**
     * Lists all Resources models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resources model.
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
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Resources model.
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
     * Check if authenticated user is owner of the rate
     * @return bool
     * @throws NotFoundHttpException
     */
    protected function isUserOwner() {
        $userId = $this->findModel(\Yii::$app->request->get('id'))->getUser()->one()->user_id;
        return $userId == \Yii::$app->user->id;
    }

    protected function findModel($id) {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}