<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;

class SwitchboardController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['admin'],
                    ],
                    
                ],
                /*'denyCallback' => function ($rule, $action) {
                            throw new \Exception('You are not allowed to access this page');
                    }*/
            ],
        ];
    }
    
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest){
            $this->redirect(['/site/login']);
        }
        return $this->render('index');
    }

}
