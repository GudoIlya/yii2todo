<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<p>
    <?= Html::a('Изменить', ['/profile/rates/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['/profile/rates/delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы уверены, что хотели бы удалить тариф?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'name'
    ],
]) ?>
