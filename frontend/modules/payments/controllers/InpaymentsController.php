<?php

namespace app\modules\payments\controllers;

use Yii;
use frontend\modules\payments\models\Inpayments;
use frontend\modules\payments\models\InpaymentsSearch;
//use frontend\modules\payments\models\Packregistration;
use frontend\modules\payments\models\Packconfig;
use frontend\modules\dashboard\models\Membership;
use frontend\modules\payments\models\Cptransactions;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Exception;
use yii\helpers\Json;
use yii\filters\AccessControl;
use yii\helpers\Url;


/**
 * InpaymentsController implements the CRUD actions for Inpayments model.
 */
class InpaymentsController extends Controller
{
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
                'only' => [ 'awaitapproval','create', 'index','pack-value','packregistration','reactivate','update','upgrade','view','check-gcodes','bcoin-payment','confirm-all-registrations'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['awaitapproval', 'create', 'index','pack-value','packregistration','reactivate','update','upgrade','view','check-gcodes','bcoin-payment','confirm-all-registrations'],
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
     * Lists all Inpayments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InpaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inpayments model.
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
     * Creates a new Inpayments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inpayments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionUpgrade($member,$ptype,$packId)
    {
         $session = Yii::$app->session;
         ////
         $memberDetails=Yii::$app->memberdetails;
         /////
         //$membership= new Membership();
        $model = $this->getInpaymentsModel($member,3);
        //$model->lookupValues($member, $ptype, $packId);
        $model->member = $member;
        $model->ptype = $ptype;
        $model->package = $packId;
        $model->amount = $memberDetails->getPackageConfig($packId,$ptype);
        if ($model->load(Yii::$app->request->post())) {
            try{
                $theDate = date('Y-m-d H:i:s');
                $model->pdate = $theDate;
                $model->recordBy = Yii::$app->user->id;
                $model->recordDate = $theDate ;
                if(Yii::$app->request->post('btn1')==2 ){//get bitcoin buttonPressed
                    $this->saveSession($model);
                    
                    $this->redirect(['cptransactions/startpay']);
                }elseif(Yii::$app->request->post('btn1')==3){//paypal button presses
                    $this->saveSession($model);
                    //save current page
                    
                    $this->redirect(['pptrx/pay','packId'=>$model->package]);
                }elseif(Yii::$app->request->post('btn1')==4){//iPay button presses
                    $this->saveSession($model);
                    $packId=$model->package;
                    //$model=null;
                    $this->redirect(['ipay/pay','packId'=>$packId]);
                }elseif($model->pMethod==5 && $model->validate()){
                    
                    $model->save();
                    $memberDetails->updateGCodesByCode($model->transactionNo,$model->pdate);
                    $memberDetails->confirmPay($model->member,$model->transactionNo,$model->pdate );
                    $memberDetails->doAutoUpgrade($model);
                    $session->setFlash('success', 'Upgrade successful .');
                    $this->redirect(['/dashboard/default/index']);
                }elseif($model->pMethod==11 && $model->validate()){
                    
                }else{
                    $session->setFlash('error', 'Unable to save payment');
                    //$this->redirect(['awaitapproval']);
                }
            }
            catch (Exception $e){
                $session->setFlash('error', 'Error saving payment: '.$e->getMessage());
            }
        }

        return $this->render('upgrade', [
            'model' => $model,
            /////
            'memberDetails' => $memberDetails,
            /////
        ]);
    }
    
    public function actionPackregistration1($member)
    {
        $memberDetails=Yii::$app->memberdetails;
        $coinPayments = Yii::$app->coinPayments;
        $userDetails = yii::$app->userdetails;
        $session= Yii::$app->session;
        
        $model = new Inpayments();
        //$model->lookupValues($member, 1);
        //$model->lookupValues($member, 1);
        if(empty($model->member)){
            //$userId = Yii::$app->user->id;
            $model->member = $member;//$userDetails->getPersonId($userId);
        }
        $model->ptype=1;
        if ($model->load(Yii::$app->request->post()) ) {
                $model->pdate = date('Y-m-d H:i:s');
                $model->recordBy = Yii::$app->user->id;
                $model->recordDate = date('Y-m-d H:i:s');
                if(Yii::$app->request->post('btn1')==2 ){//get bitcoin buttonPressed
                    $session = Yii::$app->session;
                    $session['memberId']=$model->member;
                    $session['amount']=$model->amount;
                    $session['ptype']=$model->ptype;
                    $session['package']=$model->package;
                    $coinPayments->addCpItem($model);
                    $this->redirect(['cptransactions/startpay']);
                
                }elseif($model->pMethod==5 ){
                    //confirm package from amount
                    $saidAmt = $model->amount;
                    $model->amount= $memberDetails->giftCodeValue($model->transactionNo);
                    $model->package = $memberDetails->getPackageFromValue($model->amount,1/*Registration*/,1/*packId*/);
                    ///////// end confirm amount
                    $model->save(true);
                    $msg = ($saidAmt!==$model->amount)?'Note: The value of the Gift code was $'.$model->amount.'. You have therefore been registered with a '.$memberDetails->getPackageFromValue($model->amount,1/*Registration*/,2/*Name*/).' Package!':'';
                    $memberDetails->updateGCodesByCode($model->transactionNo,$model->pdate);
                    $memberDetails->confirmPay($model->member,$model->transactionNo,$model->pdate );
                    $memberDetails->doAutoMember($model);
                     $session->setFlash('success', 'Payment accepted and you have been succesfully registered. '.$msg);
                    $this->redirect(['/dashboard/default/index']);
                }elseIf($model->pMethod==4 && $model->validate()){
                    
                }else{
                    $session->setFlash('error', 'There was an error saving the payment');
                }
    
              

            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'memberDetails' => $memberDetails,
        ]);
    }
////// packregistration test
    public function actionPackregistration($member)
    {
        $pmt= Yii::$app->pmt;
        $memberDetails=Yii::$app->memberdetails;
        //$coinPayments = Yii::$app->coinPayments;
        //$userDetails = yii::$app->userdetails;
        $session= Yii::$app->session;
        $pmt->clearInpaymentStatus();
        $pmt->clearStatusSession();
        $model = $this->getInpaymentsModel($member);
        //$model->lookupValues($member, 1);
        //$model->lookupValues($member, 1);
        /*if(empty($model->member)){
            //$userId = Yii::$app->user->id;
            $model->member = $member;//$userDetails->getPersonId($userId);
        }
        $model->ptype=1;*/
        //$backlink = Url::to(['packregistration','member'=>$member]);
        
        if ($model->load(Yii::$app->request->post()) ) {
                $model->cpRecExists = empty($model->pdate)?0:1;
                $model->pdate = empty($model->pdate)? date('Y-m-d H:i:s'):$model->pdate;
                $model->recordBy = Yii::$app->user->id;
                $model->recordDate = date('Y-m-d H:i:s');
                if(Yii::$app->request->post('btn1')==2 ){//get bitcoin buttonPressed
                    $this->saveSession($model);
                    
                    $this->redirect(['cptransactions/startpay']);
                }elseif(Yii::$app->request->post('btn1')==3){//paypal button presses
                    $this->saveSession($model);
                    //save current page
                    
                    $this->redirect(['pptrx/pay','packId'=>$model->package]);
                }elseif(Yii::$app->request->post('btn1')==4){//iPay button presses
                    $this->saveSession($model);
                    $packId=$model->package;
                    //$model=null;
                    $this->redirect(['ipay/pay','packId'=>$packId]);
                }elseif($model->pMethod==5 ){//giftcode
                    //confirm package from amount
                    $saidAmt = $model->amount;
                    $model->amount= $memberDetails->giftCodeValue($model->transactionNo);
                    $model->package = $memberDetails->getPackageFromValue($model->amount,1/*Registration*/,1/*packId*/);
                    ///////// end confirm amount
                    $model->save(true);
                    $msg = ($saidAmt!==$model->amount)?'Note: The value of the Gift code was $'.$model->amount.'. You have therefore been registered with a '.$memberDetails->getPackageFromValue($model->amount,1/*Registration*/,2/*Name*/).' Package!':'';
                    $memberDetails->updateGCodesByCode($model->transactionNo,$model->pdate);
                    $memberDetails->confirmPay($model->member,$model->transactionNo,$model->pdate );
                    $memberDetails->doAutoMember($model);
                     $session->setFlash('success', 'Payment accepted and you have been succesfully registered. '.$msg);
                    $this->redirect(['/dashboard/default/index']);
                }elseIf($model->pMethod==4 && $model->validate()){
                
                }elseif($model->pMethod==9){//Paypal
                    
                }elseif($model->pMethod==11){//iPay
                    //$memberDetails->updateGCodesByCode($model->transactionNo,$model->pdate);
                    //$memberDetails->confirmPay($model->member,$model->transactionNo,$model->pdate );
                    //$memberDetails->doAutoMember($model);
                    //$model=null;
                }else{
                    $session->setFlash('error', 'There was an error saving the payment');
                }
    
              

            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create_2', [
            'model' => $model,
            'memberDetails' => $memberDetails,
            
        ]);
    }
    
///////
    public function actionAwaitapproval()
    {
        $model = new Membership();
        $memberDetails = Yii::$app->memberdetails;
         return $this->render('awaitapproval',
                 [
                     'model' => $model,
                     'memberDetails'=>$memberDetails,
                     ]);
    }
    
    public function actionReactivate($member,$ptype,$package)
    {
         $session = Yii::$app->session;
         ////
         $memberDetails=Yii::$app->memberdetails;
         /////
        $model = new Inpayments();
        //$model->lookupValues($member,$ptype,$package);
        //$membership= new Membership();
        $model->member = $member;
        $model->ptype = $ptype;
        $model->package = $package;
        $model->amount = $memberDetails->getPackageConfig($package,$ptype);

        if ($model->load(Yii::$app->request->post())) {
//            try{
                    if($model->pMethod==5 ){
                        //confirm package from amount
                        $saidAmt = $model->amount;
                        $model->amount= $memberDetails->giftCodeValue($model->trxNo);
                        //$model->package = $memberDetails->getPackageFromValue($model->amount,1/*Registration*/,1/*packId*/);
                        ///////// end confirm amount
                        
                        //$model->save(true);
                        $model->keepValues();
                        $msg = ($saidAmt!==$model->amount)?'Note: The value of the Gift code was $'.$model->amount.'. You have therefore been registered with a '.$memberDetails->getPackageFromValue($model->amount,1/*Registration*/,2/*Name*/).' Package!':'';
                        //$memberDetails->updateGCodesByCode($model->transactionNo,$model->pdate);
                        $memberDetails->confirmPay($model->member,$model->trxNo,$model->recordDate );
                        $memberDetails->doAutoSubscribe($model);
                         $session->setFlash('success', 'Payment accepted and you have been succesfully registered. '.$msg);
                        $this->redirect(['/dashboard/default/index']);
                    }else{
                        $session->setFlash('error', 'There was an error saving the payment');
                    }
//                    $session->setFlash('success', 'Payment details successfully updated. Please await approval');
//                    $this->redirect(['awaitapproval']);
//                
//                    $session->setFlash('error','Invalid Gift Code!');
                
//            }
//            catch (Exception $e){
//                $session->setFlash('error', 'Error saving payment: '.$e->getMessage());
//            }
        }

        return $this->render('reactivate', [
            'model' => $model,
            /////
            'memberDetails' => $memberDetails,
            /////
        ]);
    }
    /**
     * Updates an existing Inpayments model.
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
     * Deletes an existing Inpayments model.
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
     * Finds the Inpayments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inpayments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inpayments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    public function actionPackValue($packid,$ptype){
        $model = Packconfig::find()
                ->where([
                    'packId'=>$packid,
                    'trxType'=>$ptype
                    ])
                ->one();
        echo Json::encode($model);
    }
    public function actionBcoinPayment($memberId,$amount,$packid,$ptype)
    {
        $memberDetails = Yii::$app->memberdetails;
        $req=array();
        $req['amount']= $amount;
        $req['currency1'] = 'USD';
        $req['currency2']='BTC';
        $req['buyer_email'] = Yii::$app->userdetails->getUserParts($memberId,2);
        $req['buyer_name'] = $memberDetails->getMemberPartsUsingPeopleId($memberId,6);
        $req['item_name'] = ($ptype==3)? $memberDetails->getPTypeName($ptype).' to '.$memberDetails->getPackName($packid):$memberDetails->getPackName($packid).' - '.$memberDetails->getPTypeName($ptype);
        $req['merchant'] = Yii::$app->params['cpMerchantId'];
        $coinPayments = Yii::$app->coinPayments;
        $result = $coinPayments->cp_api_call('create_transaction',$req);
        echo Json::encode($result);
    }
    
    public function getInpaymentsModel($member,$pType=1)
    {
        $myrec=Cptransactions::find()->where([
            'memberId'=>$member,
            'trxId'=>$pType,
                ])->one();
        $model=new Inpayments();
        $model->cpRecExists = 0;
        if(!empty($myrec)){
            $model->cpRecExists = 1;
            $model->package = $myrec->packId;
            $model->amount = $myrec->amount;
            $model->pdate = $myrec->dateStart;
            
        }//previous transaction in the offing
            $model->member = $member;
            $model->ptype = $pType;
        
        return $model;
    }
    public function saveSession($model)
    {
        $coinPayments = Yii::$app->coinPayments;
        $session = Yii::$app->session;
        $session['memberId']=$model->member;
        $session['pMethod']=$model->pMethod;
        $session['ptype']=$model->ptype;
        $session['package']=$model->package;
        $session['amount']=$model->amount=Yii::$app->memberdetails->getPackageConfig($model->package,$model->ptype);
        $session['cpRecExists'] = $model->cpRecExists;
        $session['mobileNo']= Yii::$app->memberdetails->getMemberPartsUsingPeopleId($model->member,14);
        if($model->cpRecExists==0){$coinPayments->addCpItem($model);}
    }
}
