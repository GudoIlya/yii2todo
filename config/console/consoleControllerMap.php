<?php

return [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => null,
        'migrationNamespaces' => [
            'app\migrations',
            'app\modules\todo\migrations',
            'dektrium\user\migrations\Migration'
        ]
    ],
    'migrate-app' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationNamespaces' => ['app\migrations'],
        'migrationTable' => 'migation_app',
        'migrationPath' => null
    ],
    'migrate-user' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationTable' => 'migration_user',
        'migrationPath' => 'vendor/dektrium/yii2-user/migrations'
    ]
];