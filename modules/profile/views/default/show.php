<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Menu;

/**
 * @var \yii\web\View $this
 * @var \dektrium\user\models\Profile $profile
 */

$this->title = empty($profile->name) ? Html::encode($profile->user->username) : Html::encode($profile->name);
$this->params['breadcrumbs'][] = 'Профиль пользователя '.$this->title;
?>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6">
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <?= Html::img($profile->getAvatarUrl(230), [
                    'class' => 'img-rounded img-responsive',
                    'alt' => $profile->user->username,
                ]) ?>
            </div>
            <div class="col-sm-6 col-md-8">
                <h4><?= $this->title ?></h4>
                <ul style="padding: 0; list-style: none outside none;">
                    <?php if (!empty($profile->location)): ?>
                        <li>
                            <i class="glyphicon glyphicon-map-marker text-muted"></i> <?= Html::encode($profile->location) ?>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($profile->website)): ?>
                        <li>
                            <i class="glyphicon glyphicon-globe text-muted"></i> <?= Html::a(Html::encode($profile->website), Html::encode($profile->website)) ?>
                        </li>
                    <?php endif; ?>
                    <?php if (!empty($profile->public_email)): ?>
                        <li>
                            <i class="glyphicon glyphicon-envelope text-muted"></i> <?= Html::a(Html::encode($profile->public_email), 'mailto:' . Html::encode($profile->public_email)) ?>
                        </li>
                    <?php endif; ?>
                    <li>
                        <i class="glyphicon glyphicon-time text-muted"></i> <?= Yii::t('user', 'Joined on {0, date}', $profile->user->created_at) ?>
                    </li>
                </ul>
                <?php if (!empty($profile->bio)): ?>
                    <p><?= Html::encode($profile->bio) ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- Недвижимость пользователя -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h1>Список недвижимости</h1>
        <div class="row">
            <?= Menu::widget([
                'items' => [
                    ['label' => 'Добавить недвижимость', 'url' => ['/profile/estate/create']]
                ]
            ]);?>
        </div>
        <p>
            <?= ListView::widget([
                    'itemView' => 'estate/_oneEstateItem',
                'dataProvider' => $userEstatesDP
            ]);?>
        </p>
    </div>
</div>
<!-- Тарифы пользователя -->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <h1>Список тарифов, заведенных пользователем</h1>
        <div class="row">
            <?= Menu::widget([
                'items' => [
                    ['label' => 'Добавить тариф', 'url' => ['/profile/rates/create']]
                ]
            ]);?>
        </div>
        <p>
            <?= ListView::widget([
                'itemView' => 'rates/_ratesItem',
                'dataProvider' => $userRatesDP
            ]);?>
        </p>
    </div>
</div>