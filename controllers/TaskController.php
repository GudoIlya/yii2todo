<?php

namespace app\controllers;

use yii\web\Controller;
use yii\data\Pagination;
use app\models\Task;

class TaskController extends Controller {

    public function actionIndex() {
        $query = Task::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count()
        ]);

        $tasks = $query->orderBy('title')
                 ->offset($pagination->offset)
                 ->limit($pagination->limit)
                 ->all();

        return $this->render('index', ['tasks' => $tasks, 'pagination' => $pagination]);
    }

    public function actionTasks() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $query = Task::find();
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count()
        ]);

        $tasks = $query->orderBy('title')
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        return ['tasks' => $tasks];
    }
}