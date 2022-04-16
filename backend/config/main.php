<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name' =>'Knowledge to Earn-Admin',
    'homeUrl' => 'index.php?r=switchboard/index',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'genealogy' => [
            'class' => 'backend\modules\genealogy\Module',
        ],
        'basic' => [
            'class' => 'backend\modules\basic\Module',
        ],
        'myrbac' => [
            'class' => 'backend\modules\myrbac\Module',
        ],
        'payments' => [
            'class' => 'app\modules\payments\Module',
        ],
        'reports' => [
            'class' => 'app\modules\reports\Module',
        ],
        'dashboard' => [
            'class' => 'app\modules\dashboard\Module',
        ],
        'messaging' => [
            'class' => 'app\modules\messaging\Module',
        ],
        'video' => [
            'class' => 'app\modules\video\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 600,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
        
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];
