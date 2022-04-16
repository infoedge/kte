<?php

namespace app\modules\dashboard\controllers;

use Yii;
use frontend\modules\dashboard\models\Wallet;
use frontend\modules\dashboard\models\WalletSearch;
use frontend\modules\dashboard\models\Membership;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * WalletController implements the CRUD actions for Wallet model.
 */
class WalletController extends Controller
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
                'only' => ['index','create','delete','update','view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create','delete','update','view'],
                        'roles' => ['@'],
                    ],
                    
                ],
                /*'denyCallback' => function ($rule, $action) {
                            throw new \Exception('You are not allowed to access this page');
                    }*/
            ],
        ];
    }

    /**
     * Lists all Wallet models.
     * @return mixed
     */
    public function actionIndex()
    {
        $memberDetails = Yii::$app->memberdetails;
        $session= Yii::$app->session;
        $membership = new Membership();
        $minWalletWithdrawal = $memberDetails->getAppConstant('minWalletWithdrawalAmount');
//        $walletLogin= $this->confirmWalletLogin($membership->memberId);
//        if(!$walletLogin){
//            $session->setFlash('error','Please enter to Wallet Password');
//            $this->redirect(['/dashboard/default/index']);
//        }
        $fmt = \Yii::$app->formatter;
        $trxCode = $memberDetails->fundsTransferAvailable($membership->memberId);
        $searchModel = new WalletSearch();
        $dataProvider = $searchModel->searchByMember($membership->memberId,Yii::$app->request->queryParams);
        if(Yii::$app->request->post('btn')==1){
            //add to wallet
            $rcvCode = str_replace('S', 'R', $trxCode);
            $amt = $memberDetails->fundsTransferAvailable($membership->memberId,2);
            $theDate = date('Y-m-d H:i:s');
            $memberDetails->addWalletEntry($membership->memberId,'Wallet',$theDate, 6/*Ttrx Funds*/,$rcvCode ,1,$amt);        
            //update funds transfer
            $memberDetails->updFundsTransfer($trxCode,$rcvCode,$theDate); 
            //get new value
            $trxCode = $memberDetails->fundsTransferAvailable($membership->memberId);
        }elseif(Yii::$app->request->post('btn')==2){
            $this->redirect(['/payments/withdrawal/withdraw','membership'=>$membership]);
        }elseif(Yii::$app->request->post('btn')==3){
            $this->redirect(['/payments/withdrawal/index','membership'=>$membership]);
        }
        
        return $this->render('index', [
            'membership' => $membership,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'trxCode' => $trxCode,
            'fmt' => $fmt,
            'minWalletWithdrawal'=>$minWalletWithdrawal,
        ]);
    }

    /**
     * Displays a single Wallet model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Wallet model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wallet();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Wallet model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Wallet model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Wallet model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wallet the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wallet::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function confirmWalletLogin($memberId)
    {
        
    }
}
