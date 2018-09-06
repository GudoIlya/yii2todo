<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\UsersServices */

$this->title = 'Update Users Services: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
