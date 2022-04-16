<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    //'defaultRoute' => 'home/index',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'dateFormat' => 'dd-MM-yyyy',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'currencyCode' => 'US $',
        ],
        'peopledefaults' => [
            'class' => 'common\components\PeopleDefaults',
        ],
        'memberdetails' =>[
            'class' => 'common\components\MemberDetails',
        ],
        'useful' =>[
            'class' => 'common\components\Useful',
        ],
        'userdetails' => [
            'class' => 'common\components\UserDetails',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'coinPayments'=>[
            'class' => 'common\components\CoinPayments',
        ],
        'audit'=>[
            'class' => 'common\components\Audit',
        ],
        'pmt'=>[
            'class' => 'common\components\Payment',
        ],
        'comm'=>[
            'class' => 'common\components\Communication',
        ],
        /*'request'=>array(
            'enableCsrfValidation'=>true,
        ),*/
        /*'assetManager'=>[
            'assetMap'=>[
                'pdfJs'=>'',
            ],
        ],*/
    ],
    /*'modules'=>[
        $conf = [
            
        ],
    ],*/
   
];
