<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bills\models\EstateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Моя недвижимость';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить новую', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                    'attribute' => 'title',
                    'content' => function($data) {
                        return Html::a($data->title, ['/profile/estate/view', 'id' => $data->id]);
                    }
            ],
            'space',

            ['class' => 'yii\grid\ActionColumn', 'buttons' => ['view' => function($url, $model, $key) { return '';}]],
        ],
    ]); ?>
</div>
