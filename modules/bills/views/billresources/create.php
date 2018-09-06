<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\BillResources */

$this->title = 'Create Bill Resources';
$this->params['breadcrumbs'][] = ['label' => 'Bill Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bill-resources-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
