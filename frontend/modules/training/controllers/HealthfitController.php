<?php

namespace app\modules\training\controllers;

use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class HealthfitController extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/dashboard';
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','heal001','heal002','build-link'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','heal001','heal002','build-link'],
                        'roles' => ['Gold','Diamond'],
                    ],
                    
                ],
                /*'denyCallback' => function ($rule, $action) {
                            throw new \Exception('You are not allowed to access this page');
                    }*/
            ],
        ];
    }
    public function actionHeal001()
    {
        return $this->render('heal001');
    }

    public function actionHeal002()
    {
        return $this->render('heal002');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
