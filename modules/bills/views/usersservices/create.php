<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\UsersServices */

$this->title = 'Create Users Services';
$this->params['breadcrumbs'][] = ['label' => 'Users Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-services-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
