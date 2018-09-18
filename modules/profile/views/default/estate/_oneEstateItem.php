<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<h3><?= Html::encode($model->name) ?></h3>
<p>
    <?= Html::a('Изменить', ['/profile/estate/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['/profile/estate/delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы уверены, что хотели бы удалить недвижимость?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'name',
        'space',
    ],
]) ?>
