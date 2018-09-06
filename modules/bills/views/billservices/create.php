<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\BillServices */

$this->title = 'Create Bill Services';
$this->params['breadcrumbs'][] = ['label' => 'Bill Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
