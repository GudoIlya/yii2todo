<?php

return [
    'migrate' => [
        'class' => 'yii\console\controllers\MigrateController',
        'migrationPath' => null,
        'migrationNamespaces' => [
            'app\migrations',
            'vendor\dektrium\yii2-user\migrations',
            'app\modules\catalog\migrations'
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