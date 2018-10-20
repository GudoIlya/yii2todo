<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bills\models\RatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тудушки';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="rates-index">

    <h1><?= Html::encode($this->title); ?></h1>

    <p>
        <?= Html::a('Добавить новое задание', ['create'], ['class' => 'btn btn-success']); ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],

            'task',
            'is_done',
            'created_at',

            ['class' => 'yii\grid\ActionColumn'],

        ]
    ]); ?>
</div>
