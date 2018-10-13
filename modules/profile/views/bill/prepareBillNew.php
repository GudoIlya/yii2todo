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

            <?= Html::activeHiddenInput($billForm, 'estate_id'); ?>

            <?= $form->field($billForm->bill, 'billnumber')->textInput(['maxlength' => true]) ?>

            <?= $form->field($billForm->bill, 'total')->textInput(['class' => 'totalHolder form-control']) ?>

            <?= $form->field($billForm->bill, 'date_pay')->widget(DatePicker::className(), [
                'options' => ['class' => 'form-control'],
                'dateFormat' => 'd.MM.y'
            ]) ?>
        </fieldset>

        <table class="table">
            <thead>
            </thead>
            <tbody>
            <?= $this->render('formPieces/_servicesTableForm.php', ['form' => $form, 'model' => $billForm->services]); ?>
            <?= $this->render('formPieces/_resourcesTableForm.php', ['form' => $form, 'model' => $billForm->resources]); ?>
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
