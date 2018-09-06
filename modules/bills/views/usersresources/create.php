<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\UsersResources */

$this->title = 'Create Users Resources';
$this->params['breadcrumbs'][] = ['label' => 'Users Resources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-resources-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
