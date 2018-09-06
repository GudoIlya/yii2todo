<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Estate */

$this->title = 'Create Estate';
$this->params['breadcrumbs'][] = ['label' => 'Estates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
