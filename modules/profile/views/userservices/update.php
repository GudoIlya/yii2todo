<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\bills\models\UserServices*/

$this->title = 'Update Services: ' . $model->getService()->one()->name ;
$this->params['breadcrumbs'][] = ['label' => 'Мои услуги', 'url' => ['/profile/userservices/index']];
$this->params['breadcrumbs'][] = ['label' => $model->getService()->one()->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="services-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'servicesItems' => $servicesItems,
        'ratesItems' => $ratesItems,
        'userServicesModel' => $model
    ]) ?>

</div>
