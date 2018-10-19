<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\EstateProduct*/

$currentJkhProduct = $model->getJkhProduct()->one();
$productType = $currentJkhProduct::TYPE;
$productTypeName = \app\modules\profile\models\JkhResource::TYPE == $productType ? 'ресурс' : 'услугу';
$typedProduct = false;
switch ($productType){
    case (\app\modules\profile\models\JkhResource::TYPE):
        $productTypeName = 'ресурс';
        $labelName = 'Мои ресурсы';
        break;
    case (\app\modules\profile\models\JkhService::TYPE):
        $productTypeName = 'услугу';
        $labelName = 'Мои услуги';
        break;
}


$this->title = 'Обновить '.$currentJkhProduct->name;
$this->params['breadcrumbs'][] = ['label' => $labelName, 'url' => ['/profile/estateproduct', 'type' => $productType]];
$this->params['breadcrumbs'][] = ['label' => $currentJkhProduct->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'estateItems' => $estateItems,
        'productItems' => $productItems,
        'rateItems' => $rateItems
    ]) ?>

</div>
