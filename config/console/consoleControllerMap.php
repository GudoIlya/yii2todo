<?php

return [
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