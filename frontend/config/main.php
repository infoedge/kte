<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' =>'Knowledge to Earn',
    //'homeUrl'=>'/site/index',
    //'defaultRoute'=>'/site/index',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'basic' => [
            'class' => 'frontend\modules\basic\Module',
        ],
        'dashboard' => [
            'class' => 'frontend\modules\dashboard\Module',
        ],
        'myrbac' => [
            'class' => 'backend\modules\myrbac\Module',
        ],
        'payments' => [
            'class' => 'app\modules\payments\Module',
        ],
        'training' => [
            'class' => 'app\modules\training\Module',
        ],
        'pdfjs' => [
            'class' => '\yii2assets\pdfjs\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'authTimeout' => 600,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
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
            //'class'=>'\yii\web\urlManager',
            'enablePrettyUrl' => false,
            'enableStrictParsing' => false,
            'showScriptName' => false,
//            'suffix'=>'.html',
            'rules' => [
                '<sponsor:\d{7}>/<parent:d{7}>/<lft:\d{1}>/<m:\d{1}>' => 'site/index',
                [
                   'pattern'=> '<sponsor:\d{7}>/<parent:d{7}>/<lft:\d{1}>/<m:\d{1}>',
                    'route' =>'site/index',
                    //'default' => 'site'
                ],
                    //[
                        //'controller'=>'site',
//                        '<controller:\w+>/<id:\d+>' => '<controller>/index',
//                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                       // ],
//                [
//                   'site/<action:\+w>'=>'site/<action>' 
//                ],
//                [
//                    
//                    'class' => 'yii\rest\UrlRule', 'controller' => 'user',
//                    
//                    
//                    ],
            ],
        ],
        
    ],
    'params' => $params,
];
