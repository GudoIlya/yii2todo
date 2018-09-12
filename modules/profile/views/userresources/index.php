<?php

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\bills\models\UsersResourcesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Мои ресурсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-resources-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <?= Menu::widget([
            'items' => [
                ['label' => 'Список имеющихся ресурсов', 'url' => ['/profile/resources']],
                ['label' => 'Добавить ресурс', 'url' => ['/profile/userresources/create']]
            ]
        ]);?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                    'label' => 'Наименование ресурса',
                    'content' => function($data) {
                        return $data->getResource()->one()->name;
                    }
            ],
            [
                'label' => 'Тариф',
                'content' => function($data) {
                    return $data->getRate()->one()->name;
                }
            ],
            [
                'label' => 'Цена',
                'content' => function($data) {
                    return $data->getRate()->one()->price;
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
