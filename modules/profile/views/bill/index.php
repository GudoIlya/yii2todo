<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bills\models\BillSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bills';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bills-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить новый счет', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                    'attribute' => 'billnumber',
                    'content' => function($data) {
                        return Html::a($data->billnumber, ['/profile/bill/view', 'id' => $data->id]);
                    }
            ],
            'total:currency',
            [
                    'label' => 'Недвижимость',
                    'content' => function($data) {
                        $estate = $data->getEstate()->one();
                        return Html::a($estate->name, ['/profile/estate/view', 'id' => $data->id]);
                    }
            ],
            'is_paid:boolean',
            'date_pay:date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
