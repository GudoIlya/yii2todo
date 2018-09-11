<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Estate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($estateModel, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($estateModel, 'space')->textInput() ?>

    <?= $form->field($estateOwnersModel, 'portion')->input('number', ['step' => '0.1', 'min' => 0.1, 'max' => '1', 'value' => '0.1']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
