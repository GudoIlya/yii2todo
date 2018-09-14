<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Estate */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Моя недвижимость', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_oneEstateDataView', ['model' => $model])?>
</div>
