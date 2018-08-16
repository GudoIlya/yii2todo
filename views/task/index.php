<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'Задачи';
?>
<div class="container">
    <span>Выполнить</span>
    <div class="row">

    </div>
</div>
<div class="container">
    <span>Выполнено</span>
    <div class="row">

    </div>
</div>
<ul>
    <?php foreach($tasks as $task): ?>
    <li>
        <?= Html::encode("{$task->title}"); ?> : <?= Html::encode("{$task->end_date}"); ?>
    </li>
    <?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination' => $pagination]); ?>