<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'Vaststore',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'class' => 'common\components\Request',
            'web' => '/frontend/web',
        ],
        'user' => [
            'class'=>'yii\web\User',
            'identityClass' => 'common\models\Staff',
            'enableAutoLogin' => true,
            'idParam'=>'staff',
            'identityCookie' => ['name' => 'staff_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<module:[a-z-]+>/<controller:[a-z-]+>/<action:[a-z-]+>/<id:\d+>/<param:[a-z-]+>' => '<module>/<controller>/<action>',
                '<module:[a-z-]+>/<controller:[a-z-]+>/<action:[a-z-]+>' => '<module>/<controller>/<action>',
                '<controller:[a-z-]+>/<id:\d+>' => '<controller>/view',
                '<controller:[a-z-]+>/<action:[a-z-]+>/<id:\d+>' => '<controller>/<action>',
                '<controller:[a-z-]+>/<action:[a-z-]+>/<id:\d+>/<param:[a-z-]+>' => '<controller>/<action>',
                '<controller:[a-z-]+>/<action:[a-z-]+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];
