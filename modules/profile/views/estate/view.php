<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\profile\models\Estate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Моя недвижимость', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_oneEstateItem', ['model' => $model])?>

    <ul class="nav nav-tabs">
        <li><a data-toggle="tab" href="#bills">Счета</a></li>
        <li class="active"><a data-toggle="tab" href="#services">Услуги</a></li>
        <li><a data-toggle="tab" href="#resources">Ресурсы</a></li>
    </ul>
    <div class="tab-content">
        <div id="bills" class="tab-pane fade">
            <p><?= Html::a('Добавить Cчет', ['/profile/bill/create', 'estate_id' => $model->id], ['class' => 'btn btn-success']) ?></p>
            <?= GridView::widget([
                    'dataProvider' => $model->getBillsDP(),
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

                            [
                                    'label' => 'Номер счета',
                                    'content' => function($data) {
                                        return Html::a($data->billnumber, ['/profile/bill/view', 'id' => $data->id]);
                                    }
                            ],
                            'total',
                            'is_paid',
                            'date_pay:date',

                            ['class' => 'yii\grid\ActionColumn'],
                    ],
            ]);
            ?>
        </div>
        <div id="services" class="tab-pane fade in active">
            <p><?= Html::a('Добавить услугу', ['/profile/estateproduct/create', 'estate_id' => $model->id, 'type' => \app\modules\profile\models\JkhService::TYPE], ['class' => 'btn btn-success']) ?></p>
            <?= GridView::widget([
                'dataProvider' => $model->getEstateProducts(\app\modules\profile\models\JkhService::TYPE),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label' => 'Наименование',
                        'content' => function($data) {
                            $service = $data->getJkhProduct()->one()->getService()->one();
                            return Html::a($service->name, [
                                '/profile/estateproduct/view', 'id' => $data->id
                            ]);
                        }
                    ],
                    [
                        'label' => 'Описание',
                        'content' => function($data) {
                            return $data->getJkhProduct()->one()->getService()->one()->description;
                        }
                    ],
                    [
                        'label' => 'Тариф',
                        'content' => function($data) {
                            $rate = $data->getRate()->one();
                            return Html::a($rate->name, [
                                    '/profile/rate/update', 'id' => $rate->id
                            ]);
                        }
                    ],
                    [
                            'label' => 'Цена',
                            'content' => function($data) {
                                $rate = $data->getRate()->one();
                                return $rate->price.' '.$rate->unit;
                            }
                    ],
                    ['class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                                'view' => function($url, $model, $key) {return '';},
                                'update' => function($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',
                                        ['/profile/userservices/update', 'id' => $model->id]
                                    );
                                },
                                'delete' => function($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                                        ['/profile/userservices/delete', 'id' => $model->id],
                                            [
                                                'data' => [
                                                'confirm' => 'Вы уверены, что хотите удалить услугу?',
                                                'method' => 'post',
                                            ],
                                        ]
                                    );
                                }
                        ]
                    ],
                ],
            ]); ?>
        </div>
        <div id="resources" class="tab-pane fade">
            <p><?= Html::a('Добавить ресурс', ['/profile/estateproduct/create', 'estate_id' => $model->id, 'type' => \app\modules\profile\models\JkhResource::TYPE], ['class' => 'btn btn-success']) ?></p>
            <?= GridView::widget([
                'dataProvider' => $model->getEstateProducts(\app\modules\profile\models\JkhResource::TYPE),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label' => 'Наименование',
                        'content' => function($data) {
                            $resource = $data->getJkhProduct()->one()->getResource()->one();
                            return Html::a($resource->name, [
                                '/profile/estateproduct/view', 'id' => $data->id
                            ]);
                        }
                    ],
                    [
                        'label' => 'Описание',
                        'content' => function($data) {
                            return $data->getJkhProduct()->one()->getResource()->one()->description;
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

                    ['class' => 'yii\grid\ActionColumn',
                        'buttons' => [
                            'update' => function($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/profile/estateproduct/update/'.$model->id);
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
