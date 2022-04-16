<?php

namespace app\modules\payments\controllers;

use Yii;
use frontend\modules\payments\models\Tblfundstransfer;
use frontend\modules\payments\models\TblfundstransferSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\modules\dashboard\models\Membership;
use \yii\helpers\Json;

/**
 * TblfundstransferController implements the CRUD actions for Tblfundstransfer model.
 */
class FundstransferController extends Controller
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
                'only' => ['create', 'delete', 'index','update','view','receiveFundsTransfer'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'delete', 'index','update','view','receiveFundsTransfer'],
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
     * Lists all Tblfundstransfer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblfundstransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblfundstransfer model.
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
     * Creates a new Tblfundstransfer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $model = new Tblfundstransfer();
        $membership = new Membership();
        $memberDetails = Yii::$app->memberdetails;
        $useful = Yii::$app->useful;
        $searchModel = new TblfundstransferSearch();
        $dataProvider = $searchModel->searchByMember($membership->memberId,Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //Check if funds available
            if(($model->amount*(1+( $memberDetails->getAppConstant('commissionOnFundsTransfer')/100)))< $membership->walletBal){
                $mytime = time();
            $model->memberFrom= $membership->memberId;
            $model->fundsTrxCode = 'TXS'.$mytime;
            $model->commissionCode = 'CMS'.$mytime;
            $model->dateGen = date('Y-m-d H:i:s');
            $model->memberTo = $memberDetails->getMemberPartsUsingMemberNo($model->sendMemberNo);
            $model->recordBy=Yii::$app->user->id;
            $model->recordDate= date('Y-m-d H:i:s');
            $model->save();
            $memberDetails->addWalletEntry($model->memberFrom,'Wallet',$model->dateGen, 6/*Funds Transfer*/,$model->fundsTrxCode ,-1,$model->amount);
            //add commission deduction
            $trxCommission = $model->amount*($memberDetails->getAppConstant('commissionOnFundsTransfer')/100);
            $memberDetails->addWalletEntry($model->memberFrom,'Wallet',$model->dateGen, 8/*Commission*/,$model->commissionCode ,-1,$trxCommission);
            //add Entry in tblfundstranfer
            $memberDetails->addCommissionEntry($model->memberFrom,'Wallet',$model->dateGen, 8/*Commission*/,$model->commissionCode ,1,$trxCommission);
            $session->setFlash('success','Funds Transfer to member no <strong>'.$model->sendMemberNo.'</strong> successful.');//&& sendTrxConfirm() && sendTrxNotify();
            }else{// Not enough Funds in wallet
                $session->setFlash('warning','Sorry, your wallet does not have enough funds to transfer $ '.$model->amount.'! '
                        . '<br> Either reduce the transfer amount, or transfer earnings from the commissions,<br>'
                        . ' or  request another member to transfer to you before attampting again.<br>'
                        . 'Note: There is a commission charged of '.$memberDetails->getAppConstant('commissionOnFundsTransfer').'%.<br> '
                        . 'Maximum transferrable amount is $ '.$membership->walletBal/(1+($memberDetails->getAppConstant('commissionOnFundsTransfer')/100)));
            }
            //return $this->redirect(['/dashboard/wallet/index']);
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider, 
            'memberDetails' => $memberDetails,
        ]);
    }

    public function actionReceiveFundsTransfer($memberId){
        
        $memberDetails = Yii::$app->memberdetails;
         $amt=$memberDetails->checkTransferredFunds($memberId);
         $trxEntryCode = $memberDetails->checkTransferredFunds($memberId,3);
         $theDate = date('Y-m-d H:i:s');
        if($amt>0){
            //accept funds
            $fundsRecvCode = 'TRR'.time();
            $memberDetails->addWalletEntry($memberDetails->checkTransferredFunds($memberId,2)/*memberFrom*/,'Wallet',$theDate, 8/*Commission*/,$fundsRecvCode ,1,$amt );
            $memberDetails->updFundsTransfer($trxEntryCode,$fundsRecvCode,$theDate);
            
        }
        echo Json::encode($amt);
    }
    /**
     * Updates an existing Tblfundstransfer model.
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
     * Deletes an existing Tblfundstransfer model.
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
     * Finds the Tblfundstransfer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblfundstransfer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblfundstransfer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
