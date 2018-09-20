<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.09.18
 * Time: 12:58
 */

use yii\helpers\Html;

$estateProduct = $serviceModel->getEstateProduct()->one();
$rate = $estateProduct->getRate()->one();
$jkhProduct = $estateProduct->getJkhProduct()->one();

?>

<tr class="calculateTotal">
    <td>
        <?= Html::activeHiddenInput($serviceModel, 'estate_product_id'); ?>
        <label for=""><?= $serviceModel->getEstateProduct()->one()->getJkhProduct()->one()->name; ?></label>
    </td>
    <td>
        <?= $form->field($serviceModel, 'quantity')->textInput(['value' => $estateProduct->default_value, 'class' => 'form-control quantityHolder'])->label(''); ?>
    </td>
    <td>
        <?= $form->field($serviceModel, 'current_counter_value')->textInput()->label(''); ?>
    </td>
    <td>
        <h5 class="rateHolder"><?= $rate->price ?></h5>
    </td>
    <td>
        <p class="resultHolder"><?= $estateProduct->default_value * $rate->price; ?></p>
    </td>
</tr>


