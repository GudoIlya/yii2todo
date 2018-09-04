<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RateCategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rate Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Rate Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= $this->render('_rateCategoriesGrid', [
            'dataProvider' => $dataProvider,
            'searchModel'  => $searchModel,
    ]); ?>
</div>
