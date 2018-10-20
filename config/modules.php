<?php

return [
    'user' => [
        'class' => 'dektrium\user\Module',
        'enableConfirmation' => false,
        'enableUnconfirmedLogin' => true,
        'admins' => ['igudov'],
        'modelMap' => [
            'User' => 'app\models\UserCustom',
            'RegistrationForm' => 'app\models\RegistrationForm'
        ],
    ],
    'admin' => [
        'class' => 'app\modules\admin\Module',
    ],
    'bills' => [
        'class' => 'app\modules\bills\Module'
    ],
    'profile' => [
        'class' => 'app\modules\profile\Module'
    ],
    'todo' => [
        'class' => 'app\modules\todo\Module'
    ],
    'catalog' => [
        'class' => 'app\modules\catalog\Module'
    ],
    'yandexapi' => [
        'class' => 'app\modules\yandexapi\Module',
        'token' => 'c084076f-85f1-4f82-b595-0fd390342587'
    ],
];