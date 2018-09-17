<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Estate */

$this->title = 'Update Estate: ' . $estateModel->name;
$this->params['breadcrumbs'][] = ['label' => 'Моя недвижимость', 'url' => ['/profile/estate']];
$this->params['breadcrumbs'][] = ['label' => $estateModel->name, 'url' => ['view', 'id' => $estateModel->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="estate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $estateModel
    ]) ?>

</div>
