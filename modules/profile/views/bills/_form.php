<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Bills */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bills-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bill_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estate_id')->dropDownList([
        $estateItems
    ], ['prompt' => 'Для какой недвижимости счет?']); ?>

    <?= $form->field($model, 'services_summ')->textInput() ?>

    <?= $form->field($model, 'resources_summ')->textInput() ?>

    <?= $form->field($model, 'is_paid')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
