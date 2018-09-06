<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\EstateOwners */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estate Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-owners-view">

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
            'id',
            'user_id',
            'estate_id',
            'portion',
        ],
    ]) ?>

</div>
