<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\EstateOwners */

$this->title = 'Create Estate Owners';
$this->params['breadcrumbs'][] = ['label' => 'Estate Owners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estate-owners-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
