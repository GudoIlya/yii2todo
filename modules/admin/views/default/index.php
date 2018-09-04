<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;

$this->title = 'А панель';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-default-index">
    <h1><?= $this->title ?></h1>
    <?php
    NavBar::begin(['brandLabel' => 'А панель нав']);
    echo Nav::widget([
            'items' => [
                    ['label' => 'Создать категорию тарифов', 'url' => ['/ratecategories/create']],
            ],
            'options' => ['class' => 'navbar-nav'],
    ]);
    NavBar::end();
    ?>
    <?= $this->render('@app/views/ratecategories/_rateCategoriesGrid', [
            'dataProvider' => $rateCategoriesDataProvider,
            'searchModel'  => $rateCategoriesSearchModel
    ]); ?>
</div>
