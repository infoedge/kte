<?php

namespace app\modules\payments\controllers;

use Yii;
use frontend\modules\dashboard\models\Wallet;
use frontend\modules\dashboard\models\WalletSearch;
use frontend\modules\dashboard\models\Membership;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class PptrxController extends Controller
{
    public $layout = 'dashboard';
    /**
     * {@inheritdoc}
     */
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
                'only' => ['index','pay','cancel','resume','success'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage','cancel','success'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','pay','resume'],
                        'roles' => ['@'],
                    ],
                    
                ],
                /*'denyCallback' => function ($rule, $action) {
                            throw new \Exception('You are not allowed to access this page');
                    }*/
            ],
        ];
    }
    public function actionCancel()
    {
        return $this->render('cancel');
    }

    public function actionPay($packId)
    {
        
        return $this->render('pay',['optn'=>$packId]);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionResume()
    {
        return $this->render('resume');
    }

    public function actionSuccess()
    {
        return $this->render('success');
    }

}
