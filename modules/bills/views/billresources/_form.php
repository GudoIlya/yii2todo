<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\BillResources */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bill-resources-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'resource_id')->textInput() ?>

    <?= $form->field($model, 'bill_id')->textInput() ?>

    <?= $form->field($model, 'rate_id')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'summ')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
