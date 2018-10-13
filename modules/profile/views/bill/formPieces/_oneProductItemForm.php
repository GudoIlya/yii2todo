<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.09.18
 * Time: 12:58
 */

use yii\helpers\Html;

$prefix = "[$index][$subindex]";
?>

<tr class="calculateTotal">
    <td>
        <?= Html::activeHiddenInput($model, $prefix.'estate_product_id'); ?>
        <label for=""><?= $model->estate_product->getJkhProduct()->one()->name; ?></label>
    </td>
    <td>
        <?= $form->field($model->billProduct, $prefix.'quantity')->textInput(['value' => $model->estate_product->default_value, 'class' => 'form-control quantityHolder'])->label(''); ?>
    </td>
    <td>
        <?= $form->field($model->billProduct, $prefix.'current_counter_value')->textInput()->label(''); ?>
    </td>
    <td>
        <h5 class="rateHolder"><?= $model->rate->price ?></h5>
    </td>
    <td>
        <p class="resultHolder"><?= $model->result; ?></p>
    </td>
</tr>


