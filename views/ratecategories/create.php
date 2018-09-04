<?php

/* @var $this yii\web\View */
/* @var $model app\models\RateCategories */

$this->title = 'Создание категории тарифа';
$this->params['breadcrumbs'][] = ['label' => 'Rate Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

echo $this->render('createform', ['model' => $model]);
?>

