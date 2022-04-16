<?php

namespace app\modules\payments\controllers;

use Yii;
use frontend\modules\payments\models\Pay;
//use frontend\modules\payments\models\CptransactionsSearch;
use frontend\modules\payments\models\Inpayments;
use frontend\modules\payments\models\Ipychannels;
use frontend\modules\payments\models\Ipytrxstatus;
//use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use yii\web\JsonParser;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;

class IpayController extends \yii\web\Controller {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['confirmpay', 'status', 'pay', 'fetch-phone-no'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['confirmpay', 'status', 'pay', 'fetch-phone-no'],
                        'roles' => ['@'],
                    ],
                ],
            /* 'denyCallback' => function ($rule, $action) {
              throw new \Exception('You are not allowed to access this page');
              } */
            ],
        ];
    }

    public function actionConfirmpay($status, $txncd, $msisdn_id, $msisdn_idnum, $p1, $p2, $p3, $p4, $uyt, $agt, $qwh, $ifd, $afd, $poi, $id, $ivm, $mc, $channel) {
        $session = Yii::$app->session;
        $pmt = Yii::$app->pmt;
        $memberDetails = Yii::$app->memberdetails;
        $model = Pay::findOne($p2);
        $statusArr = array(
            'status' => $this->getStatusName($status),
            'statusId' => $this->getStatusName($status, 2),
            'trxId' => $txncd,
            'amountPaid' => $mc,
            'amountReq' => $model->amount,
            'payerName' => $msisdn_id,
            'phoneNo' => $msisdn_idnum,
            'cpTrxId' => $p2,
            'channel' => $p1,
            'memberId' => $p3,
            'ptype' => $p4,
            'pMethod' => 11,
            'packId' => $model->packId,
            'theDate' => date('Y-m-d H:i:s'),
        );
        // Confirm paymet and register
        $pmt->updCptransactionStatus($statusArr);
        // Log  status
        $pmt->addIpyStatusLogs($statusArr);
        $pmt->saveStatus($statusArr);
        if ($statusArr['status'] == 'Success' || $statusArr['status'] == 'More') {
            //update the TransacionNo in inpayments
            //$statusArr['inpaymentsId']=$pmt->insIpayInpayments($statusArr);
            //$pmt->confirmInpayments($statusArr);
            //if (!empty($model = Inpayments::findOne($pmt->getCptrxDetails($statusArr['cpTrxId'])))) {
            //    $memberDetails->doAutoMember($model);
            //}
            $session->setFlash('success', 'Welcome to the Knowledgetoearn Dashboard. You have been succesfully registered. ');
            if ($statusArr['status'] == 'More') {
                $extra = $statusArr['amountReq']-$statusArr['amountPaid'];
                $session->addFlash('warning', 'You paid more than was required by $'.$extra.'. This amount shall be placed in your wallet.');
            }
            $this->redirect(['status']);
            //$this->redirect(['/dashboard/default/index']);
        } else {
            
            $this->redirect(['status']);
        }
        return $this->render('confirmpay', [
                    'statusArr' => $statusArr,
        ]);
    }

    public function actionPay() {
        $session = Yii::$app->session;
        $pmt = Yii::$app->pmt;
        //$memberDetails = Yii::$app->memberdetails;
        $memberId = $session['memberId'];
        Url::remember(['inpayments/packregistration', 'member' => $memberId]);
        $trxId = $session['ptype'];
        if (!empty($model = Pay::find()->where(['memberId' => $memberId, 'trxId' => $trxId])->one())) 
        {
            $myroute = "";
            $hashid = "";
            $model->e_mail= $model->member->user->email;
            $dataArr = array();
            //$model->mobileNo = 
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {
                if(Yii::$app->request->post('btn1')==2){$this->redirect(Url::previous());} //Cancel
                $chn=$model->channel;
                $theChannel = $this->getChannelSymbol($model->channel);
                if($chn==1||$chn==3||$chn==4||$chn==14){ //KES
                    //Fill currency and exchange Rate
                    $model->currency =2;
                    $model->xchangeRate= $pmt->getExchangeRate(2/*KES*/);
                }else{// US$
                    $model->currency =1;
                    $model->xchangeRate= $pmt->getExchangeRate(1/*USD*/);
                }
                $model->save();
                
                //$memberDetails->updInpayments($model);
                //$datastring =  $live.$order_id.$invoice.$total.$phone.$email.$vid.$curr.$p1.$p2.$p3.$p4.$cbk.$cst.$crl;
                $dataArr = $this->formDataStr($model);
                $datastring = $dataArr['live']//1 is the channel
                        . $dataArr['oid'] . $dataArr['inv'] . $dataArr['ttl']
                        . $dataArr['tel'] . $dataArr['eml'] . $dataArr['vid'] . $dataArr['curr']
                        . $dataArr['p1'] . $dataArr['p2'] . $dataArr['p3'] . $dataArr['p4'] . $dataArr['cbk']
                        . $dataArr['cst'] . $dataArr['crl'];
                $hashkey = Yii::$app->params['ipyLive'] == 0 ? "demoCHANGED" : Yii::$app->params['ipysk'];
                $hashid = hash_hmac("sha1", $datastring, $hashkey);
                //Yii::setAlias('@ipy', 'https://payments.ipayafrica.com/v3/ke');
                $myroute = Url::to('https://payments.ipayafrica.com/v3/ke?' . $this->GetParamString($dataArr) . '&hsh=' . $hashid);
                $this->redirect($myroute);
            }
        }
        return $this->render('pay', [
                    'model' => $model,
                    'generated_hash' => $hashid,
                    'dataArr' => $dataArr,
                    'myroute' => $myroute,
        ]);
    }

    public function actionStatus() {
        $pmt=Yii::$app->pmt;
        $memberDetails = Yii::$app->memberdetails;
        $statusArr = $pmt->recallStatus();
        //create and save the model
        //$model=$this->populateInpayments($statusArr);
        //Register
        if((Yii::$app->request->post('btn1')==1) && (($statusArr['status']=='Success') || ($statusArr['status']=='More'))&&($statusArr['ptype']==1)){
            $pmt->insIpayInpayments($statusArr);
            //confirm payment
            $model=Inpayments::find()->where(['member'=>$statusArr['memberId'],'ptype'=>$statusArr['ptype']])->one();
            $memberDetails->confirmPay($model->member,$model->transactionNo,$model->pdate );
            //update the Wallet
            //addWalletEntry($member,$tbl,$trxDate, $trxMethod,$trxId ,$trxDir,$amt)
            $memberDetails->addWalletEntry($statusArr['memberId'],'Wallet',$statusArr['theDate'],'11','PMT'.$statusArr['trxId'],1,$statusArr['amountPaid']);
            $memberDetails->addWalletEntry($statusArr['memberId'],'payment',$statusArr['theDate'],'11','RGN'.$statusArr['trxId'],-1,$statusArr['amountReq']);
            //Register
            $memberDetails->doAutoMember($model);
            $this->redirect(['/dashboard/default/index']);
        }//upgrade
        elseif((Yii::$app->request->post('btn1')==1) && (($statusArr['status']=='Success') || ($statusArr['status']=='More'))&&($statusArr['ptype']==3)){
            $pmt->insIpayInpayments($statusArr);
            //confirm payment
            $model=Inpayments::find()->where(['member'=>$statusArr['memberId'],'ptype'=>$statusArr['ptype']])->one();
            $memberDetails->confirmPay($model->member,$model->transactionNo,$model->pdate );
            //update the Wallet
            //addWalletEntry($member,$tbl,$trxDate, $trxMethod,$trxId ,$trxDir,$amt)
            $memberDetails->addWalletEntry($statusArr['memberId'],'Wallet',$statusArr['theDate'],'11','PMT'.$statusArr['trxId'],1,$statusArr['amountPaid']);
            $memberDetails->addWalletEntry($statusArr['memberId'],'payment',$statusArr['theDate'],'11','UPG'.$statusArr['trxId'],-1,$statusArr['amountReq']);
            //Upgrade
            $memberDetails->doAutoUpgrade($model);
            //$model=null;
            $this->redirect(['/dashboard/default/index']);
        }elseif((Yii::$app->request->post('btn1')==2)){//failed payment
            $this->redirect(['pay']);
        }
        return $this->render('status', [
                    'statusArr' => $statusArr,
                    //'model' => $model,
        ]);
    }

    private function formDataStr($model) {
        $useful = Yii::$app->useful;
        $param = Yii::$app->params;
        $pmt = Yii::$app->pmt;
        $chn = $model->channel;
        $mobno = $model->mobileNo;
        $retStr = array(
            'live' => $param['ipyLive'],
            //cptransactions oerderId consists of trxId(99)+packId(99)+memberId (99999999)       
            'oid' => $useful->x_digit($model->trxId, 2) . $useful->x_digit($model->packId, 2) . $useful->x_digit($model->memberId, 8),
            //cptransactions.Id forms the InvoiceID(99999999)
            'inv' => $useful->x_digit($model->id, 8),
            //'ttl' => ($chn==1||$chn==3||$chn==4||$chn==14)?$model->amount*$pmt->getExchangeRate(2/*KES*/):$model->amount,
            'ttl' => ($model->currency==2)?$model->amount*$pmt->getExchangeRate(2/*KES*/):$model->amount,
            //'tel' => ($chn==1||$chn==3||$chn==4||$chn==14)?$mobno:Yii::$app->useful->makePureAlphaNum($model->member->phoneNo),
            'tel' => ($model->currency==2)?$mobno:Yii::$app->useful->makePureAlphaNum($model->member->phoneNo),
            'eml' => $model->e_mail,
            'vid' => ($param['ipyLive'] == 0) ? "demo" : $param['ipyVendorId'],
            //'curr' => ($chn==1||$chn==3||$chn==4||$chn==14)? $pmt->getCurrencyParts(2):$param['ipyCurrency'],
            'curr' => $pmt->getCurrencyParts($model->currency),
            'p1' => $this->getChannelSymbol($chn), //payChannel
            'p2' => $model->id,
            'p3' => $model->memberId,
            'p4' => $model->trxId,
            'cbk' => str_replace("%2F", "/", Html::encode(Url::to(['confirmpay'], true))),
            'cst' => "1",
            'crl' => "2",
        );
        return $retStr;
        //return $live.$oid.$invoice.$total.$phone.$email.$vid.$curr.$p1.$p2.$p3.$p4.$cbk.$cst.$crl;    
    }

    public function getChannelSymbol($channel,$optn=1) {

        if (!empty($chn = ipyChannels::findOne($channel))) {
            switch($optn){
                case 1:
                    return $chn->symbol;
                case 2:
                    return $chn->channelName;
            }
        } else {
            throw new NotFoundHttpException('The requested channel does not exist.');
        }
    }

    private function getParamString($dataArr) {
        $myarr = $dataArr;
        $strOut = '';
        foreach ($dataArr as $key => $value) {
            if (empty($strOut)) {
                $strOut .= $key . '=' . $value;
            } else {
                $strOut .= '&' . $key . '=' . $value;
            }
        }
        return $strOut;
    }

    private function getStatusName($status, $fmt = 1) {
        $model = Ipytrxstatus::find()->where(['code' => $status])->one();
        switch ($fmt) {
            case 1:
                return $model->name;
            case 2:
                return $model->id;
        }
    }
    /**
     * 
     * @param type $statusArr
     * @return Inpayments
     * creates and saves an Inpayment record
     */
    public function populateInpayments($statusArr)
    {
        $model= new Inpayments();
        $model->member = $statusArr['memberId'];
        $model->package = $statusArr['packId'];
        $model->ptype = $statusArr['ptype'];
        $model->amount = $statusArr['amountReq'];
        $model->pdate = $statusArr['theDate'];
        $model->pMethod = 11;//$statusArr['pMethod'];
        $model->transactionNo = $statusArr['trxId'];
        $model->comments = 'Channel: '.$statusArr['trxId'];
        $model->recordBy = Yii::$app->user->id;
        $model->recordDate = date("Y-m-d H:i:s");
        //$model->save();
        return $model;
    }
    
    public function getMobileNo($memberId){
        $comm = Yii::$app->comm;
        $memberDetails = Yii::$app->memberdetails;
        $phoneNo = $memberDetails->getMemberPartsUsingPeopleId($memberId,14);
        $countryId = $memberDetails->getMemberPartsUsingPeopleId($memberId,15);
        return $comm->removePhoneCountryCode($phoneNo,$countryId);
    }
    
    public function actionFetchPhoneNo($memberid){
        $memberdetails = Yii::$app->memberdetails;
        $phoneNo = $memberdetails->getMemberPartsUsingPeopleId($memberid,14);
        $countryId = $memberdetails->getMemberPartsUsingPeopleId($memberid,15);
        $comm = Yii::$app->comm;
        echo Json::encode( $comm->removePhoneCountryCode($phoneNo,$countryId));
    }
}
