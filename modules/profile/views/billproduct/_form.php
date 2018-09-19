<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Services */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="services-form">

    <?php $form = ActiveForm::begin(); ?>

    <h3>Список уже имеющихся Услуг</h3>

    <?= $form->field($model, 'bill_id')->hiddenInput() ?>

    <?= $form->field($model, 'estate_product_id')->dropDownList([
        $productItems
    ], ['prompt' => 'Выберете предоставляемый товар']) ?>

    <?= $form->field($model, 'current_counter_value')->textInput(); ?>

    <?= $form->field($model, 'quantity')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
