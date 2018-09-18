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

    <?= $form->field($model, 'estate_id')->dropDownList([
        $estateItems
    ], ['prompt' => 'Для какой недвижимости ресурс?']); ?>

    <?= $form->field($model, 'service_id')->dropDownList([
        $productItems
    ], ['prompt' => 'Существующую услугу']) ?>

    <?= $form->field($model, 'current_rate')->dropDownList([
        $rateItems
    ], ['prompt' => 'Выберите действующий тариф']) ?>

    <?= $form->field($model, 'default_value')->textInput(['maxlength' => true]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
