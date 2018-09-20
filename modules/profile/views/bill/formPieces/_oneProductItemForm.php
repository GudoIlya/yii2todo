<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.09.18
 * Time: 12:58
 */

use yii\helpers\Html;

$estateProduct = $model->getEstateProduct()->one();
$rate = $estateProduct->getRate()->one();
$jkhProduct = $estateProduct->getJkhProduct()->one();
$prefix = "[$index][$subindex]";
?>

<tr class="calculateTotal">
    <td>
        <?= Html::activeHiddenInput($model, $prefix.'estate_product_id'); ?>
        <label for=""><?= $model->getEstateProduct()->one()->getJkhProduct()->one()->name; ?></label>
    </td>
    <td>
        <?= $form->field($model, $prefix.'quantity')->textInput(['value' => $estateProduct->default_value, 'class' => 'form-control quantityHolder'])->label(''); ?>
    </td>
    <td>
        <?= $form->field($model, $prefix.'current_counter_value')->textInput()->label(''); ?>
    </td>
    <td>
        <h5 class="rateHolder"><?= $rate->price ?></h5>
    </td>
    <td>
        <p class="resultHolder"><?= $estateProduct->default_value * $rate->price; ?></p>
    </td>
</tr>


