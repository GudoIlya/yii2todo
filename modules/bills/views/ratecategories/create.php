<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\RateCategories */

$this->title = 'Create Rate Categories';
$this->params['breadcrumbs'][] = ['label' => 'Rate Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
