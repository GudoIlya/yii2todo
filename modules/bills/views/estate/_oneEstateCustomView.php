<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.09.18
 * Time: 12:48
 */
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<h3><?= Html::encode($model->title) ?></h3>
<p>
    <?= Html::a('Изменить', ['bills/estate/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
        'id',
        'title',
        'space',
    ],
]) ?>
