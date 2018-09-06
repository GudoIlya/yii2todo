<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\BillServices */

$this->title = 'Update Bill Services: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bill Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bill-services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
