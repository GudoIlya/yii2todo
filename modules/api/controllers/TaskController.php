<?php
namespace app\modules\api\controllers;

use yii\rest\ActiveController;

class TasksContoller extends ActiveController {

    public $modelClass = "app\modules\todo\models\task\Task";


}