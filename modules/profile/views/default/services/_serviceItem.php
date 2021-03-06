<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>
<p>
    <?= Html::a('Изменить', ['/profile/userservices/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['/profile/userservices/delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
            'confirm' => 'Вы уверены, что хотели бы удалить услугу?',
            'method' => 'post',
        ],
    ]) ?>
</p>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
                'label' => 'Наименование услуги',
                'value' => $model->getEstateProducts(\app\modules\profile\models\Jkhproduct::servicesId)->name,
        ],
    ],
]) ?>
