<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Rates */

$this->title = 'Обновить задачу: ' . $model->task;
$this->params['breadcrumbs'][] = ['label' => 'Тудушки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->task, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="todos-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
