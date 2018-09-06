<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Estate */

$this->title = 'Update Estate: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Estates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
