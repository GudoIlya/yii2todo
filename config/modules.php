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
];