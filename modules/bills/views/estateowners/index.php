<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bills\models\EstateOwnersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estate Owners';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-owners-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Estate Owners', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'estate_id',
            'portion',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
