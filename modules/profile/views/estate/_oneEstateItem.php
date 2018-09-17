<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<p>
    <?= Html::a('Изменить', ['/profile/estate/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['bills/estate/delete', 'id' => $model->id], [
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
        'name',
        'space',
        'user_portion'
    ],
]) ?>
