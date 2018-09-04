<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 04.09.18
 * Time: 16:03
 */

use yii\helpers\Html;

?>
<div class="rate-categories-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>