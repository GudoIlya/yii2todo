<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\Bills */

$this->title = 'Заведение нового счета';
$this->params['breadcrumbs'][] = ['label' => 'Мои счета', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bills-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'estateItems' => $estateItems
    ]) ?>

</div>
