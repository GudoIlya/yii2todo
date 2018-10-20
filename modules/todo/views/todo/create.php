<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Rates */

$this->title = 'Добавление задачи';
$this->params['breadcrumbs'][] = ['label' => 'Тудушки', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rates-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model
    ]) ?>

</div>
