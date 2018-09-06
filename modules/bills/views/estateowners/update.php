<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\EstateOwners */

$this->title = 'Update Estate Owners: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estate Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estate-owners-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
