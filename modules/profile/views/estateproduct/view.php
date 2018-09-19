<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Services */

$currentProduct = $model->getJkhProduct()->one();
$this->title = $currentProduct->name;
$this->params['breadcrumbs'][] = ['label' => $currentProduct::TYPE == \app\modules\profile\models\JkhService::TYPE ? 'Мои услуги' : 'Мои ресурсы', 'url' => ['/profile/estateproduct', 'type' => $currentProduct::TYPE]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="services-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Недвижимость',
                'value' => $model->getEstate()->one()->name
            ],
            [
                    'label' => 'Продукт',
                    'value' => $currentProduct->name
            ],
            [
                    'label' => 'Тариф',
                    'value' => function($model) {
                        $rate = $model->getRate()->one();
                        return $rate->name." цена:".$rate->price;
                    }
            ],
            [
                    'label' => 'Норматив',
                    'value' => $model->default_value
            ]
        ],
    ]) ?>

</div>
