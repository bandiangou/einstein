<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'defaultRoute'=>'people/index',
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
            'errorAction' => 'people/error',
        ],
        'db'=>[
            'class'=>'yii\db\connection',
            'dsn'=>'mysql:host=localhost;dbname=timeline',
            'username'=> 'root',
            'password'=>'12345678',
            'charset'=>'utf8',
        ]
    ],
    'params' => $params,
];
