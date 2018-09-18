<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bills\models\RatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои тарифы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rates-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить тариф', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'price',
            'unit',
            'product_id',
            'date_create',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
