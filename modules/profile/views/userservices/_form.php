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

    <?= $form->field($userServicesModel, 'estate_id')->dropDownList([
        $estateItems
    ], ['prompt' => 'Для какой недвижимости ресурс?']); ?>

    <?= $form->field($userServicesModel, 'service_id')->dropDownList([
        $servicesItems
    ], ['prompt' => 'Существующую услугу']) ?>

    <?= $form->field($userServicesModel, 'current_rate')->dropDownList([
        $ratesItems
    ], ['prompt' => 'Выберите действующий тариф']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
