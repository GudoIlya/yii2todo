<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Bills */

$this->title = 'Заведение нового счета';
$this->params['breadcrumbs'][] = ['label' => 'Мои счета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="bills-form">

        <?php $form = ActiveForm::begin(); ?>
        <fieldset name="billModel">

            <?= Html::activeHiddenInput($billModel, 'estate_id'); ?>

            <?= $form->field($billModel, 'billnumber')->textInput(['maxlength' => true]) ?>

            <?= $form->field($billModel, 'total')->textInput(['class' => 'totalHolder form-control']) ?>

            <?= $form->field($billModel, 'date_pay')->widget(DatePicker::className(), [
                        'options' => ['class' => 'form-control'],
                        'dateFormat' => 'd.MM.y'
            ]) ?>

        </fieldset>
        <table class="table">
            <thead>
            </thead>
            <tbody>
                <?= $this->render('formPieces/_servicesTableForm.php', ['form' => $form, 'model' => $servicesModels]); ?>
                <?= $this->render('formPieces/_resourcesTableForm.php', ['form' => $form, 'model' => $resourcesModels]); ?>
            </tbody>
        </table>


        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>

<?php
    $this->registerJsFile('js/bill/prepareBill/prepareBill.js', ['depends' => [yii\jui\JuiAsset::className()]]);
?>
