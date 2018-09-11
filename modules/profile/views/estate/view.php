<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Estate */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Estates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-view">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_oneEstateItem', ['model' => $model])?>

</div>
