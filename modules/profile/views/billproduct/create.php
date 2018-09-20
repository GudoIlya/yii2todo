<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Services */

$this->title = 'Добавление продукта';
$this->params['breadcrumbs'][] = ['label' => 'Счет', 'url' => ['/profile/bill/view', 'id'=>$model->bill_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productItems' => $productItems
    ]) ?>

</div>
