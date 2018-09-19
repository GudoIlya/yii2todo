<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Bills */

$this->title = "Счет - ".$model->billnumber;
$this->params['breadcrumbs'][] = ['label' => 'Счета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bills-view">

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
            'billnumber',
            'date_pay:date',
            'total',
            [
                'label' => 'Недвижимость',
                'value' => $model->getEstate()->one()->name
            ],
            'is_paid:boolean',
        ],
    ]) ?>

    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#services">Услуги</a></li>
        <li><a data-toggle="tab" href="#resources">Ресурсы</a></li>
    </ul>
    <div class="tab-content">
        <div id="services" class="tab-pane fade in active">
            <p><?= Html::a('Добавить услугу', ['/profile/billproduct/create', 'bill_id' => $model->id, 'type' => \app\modules\profile\models\JkhService::TYPE], ['class' => 'btn btn-success']) ?></p>
            <?= GridView::widget([
                'dataProvider' => $model->getBillProductsDP(\app\modules\profile\models\JkhService::TYPE),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    [
                        'label' => 'Наименование',
                        'content' => function($data) {
                            $service = $data->getEstateProduct()->one()->getJkhProduct()->one()->getService()->one();
                            return Html::a($service->name, [
                                '/profile/estateproduct/view', 'id' => $data->id
                            ]);
                        }
                    ],
                    [
                        'label' => 'Описание',
                        'content' => function($data) {
                            return $data->getEstateProduct()->one()->getJkhProduct()->one()->getService()->one()->description;
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
                                    ['/profile/billproduct/update', 'id' => $model->id]
                                );
                            },
                            'delete' => function($url, $model, $key) {
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>',
                                    ['/profile/billproduct/delete', 'id' => $model->id],
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
            <p><?= Html::a('Добавить ресурс', ['/profile/billproduct/create', 'bill_id' => $model->id, 'type' => \app\modules\profile\models\JkhResource::TYPE], ['class' => 'btn btn-success']) ?></p>
            <?= GridView::widget([
                'dataProvider' => $model->getBillProductsDP(\app\modules\profile\models\JkhResource::TYPE),
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
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '/profile/billproduct/update/'.$model->id);
                            }
                        ]
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
