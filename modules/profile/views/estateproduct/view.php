<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Services */

$this->title = $model->getService()->one()->name;
$rate = $model->getRate()->one();
$this->params['breadcrumbs'][] = ['label' => 'Мои услуги', 'url' => ['/profile/userservices']];
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
                'label' => 'Наименование услуги',
                'value' => $model->getService()->one()->name
            ],
            [
                    'label' => 'Наименование Тарифа',
                    'value' => $rate->name
            ],
            [
                    'label' => 'Цена',
                    'value' => $rate->price
            ]
        ],
    ]) ?>

</div>
