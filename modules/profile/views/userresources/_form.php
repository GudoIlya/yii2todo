<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\UsersResources */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-resources-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'resource_id')->dropDownList([
        $resourceItems
    ], ['prompt' => 'Существующую услугу']) ?>

    <?= $form->field($model, 'current_rate')->dropDownList([
        $rateItems
    ], ['prompt' => 'Выберите действующий тариф']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
