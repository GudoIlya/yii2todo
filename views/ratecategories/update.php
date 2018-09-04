<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RateCategories */

$this->title = 'Update Rate Categories: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rate Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rate-categories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
