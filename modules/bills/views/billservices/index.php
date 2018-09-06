<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bills\models\BillServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bill Services';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-services-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bill Services', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'service_id',
            'bill_id',
            'rate_id',
            'quantity',
            //'summ',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
