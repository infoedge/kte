<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use Yii;
use yii\base\Component;

/**
 * Description of Payment
 *
 * @author Apache1
 */
class Payment extends Component{
    /**
     * confirms
     * @param type $memberId
     */
    
    /*  $trxArr Array format
         * 
         * $trxArr=array(
            'status'=>$this->getStatusName($status),
            'statusId' => $this->getStatusName($status,2),
            'trxId' => $txncd,
     *      'amount'=> $mc,
            'payerName' => $msisdn_id,
            'phoneNo'=> $msisdn_idnum,
            'cpTrxId' => $p2,
            'channel'=> $p1,
            'memberId'=>$p3,
            'ptype'=> $p4,
     *      'pMethod'=>11,
            'packId'=>$model->packId,
        ); */
    
    public function insIpayInpayments($trxArr)
    {
        $db = Yii::$app->db;
        $db->createCommand()->insert('inpayments',[
            'member'=>$trxArr['memberId'],
            'package'=>$trxArr['packId'],
            'ptype'=>$trxArr['ptype'],
            'pMethod' => $trxArr['pMethod'],
            'pdate'=> $trxArr['theDate'],
            'amount'=>$trxArr['amountReq'],
            'transactionNo'=>$trxArr['trxId'],
            'recordDate'=>$trxArr['theDate'],
            'recordBy' => Yii::$app->user->id,
            
        ])->execute();
        //return $db->lastInsertID;
    }
    
    public function addIpyStatusLogs($trxArr)
    {
         $db = Yii::$app->db;
        $db->createCommand()->insert('ipytrxlogs',[
            'cpId'=> $trxArr['cpTrxId'],
            'status'=>$trxArr['statusId'],
            'statusDate'=>$trxArr['theDate'],
            'txncd' => $trxArr['trxId'],
            'msisdn_id'=>$trxArr['payerName'],
            'msisdn_idnum'=>$trxArr['phoneNo'],
        ])->execute();
    }
    
    public function updCptransactionStatus($trxArr)
    {
        $db = Yii::$app->db;
        $db->createCommand()->update('cptransactions',[
            'status'=>$trxArr['status'],
            'statusDate'=>$trxArr['theDate'],
            'trxNo' => $trxArr['trxId'],
            'mediaNoUsed' => $trxArr['phoneNo'],
        ],[
            'id'=>$trxArr['cpTrxId'],
        ])->execute();
    }
    /**
     * 
     * @param type $trxArr
     * @param type $thedate
     */
    public function confirmInpayments($trxArr)
    {
        $db = Yii::$app->db;
        $db->createCommand()->update('inpayments',[
            'pdate'=> $trxArr['theDate'],
            'confirmDate'=>$trxArr['theDate'],
            'confirmed' => 1,
            'confirmBy' => 2//infoedge
        ],[
            'id'=>$this->getCptrxDetails($trxArr['cpTrxId']),//look for package
        ])->execute();
    }
    
    public function getCptrxDetails($id,$optn=1)
    {
        $qry = (new \yii\db\Query());
        $myvals=$qry->select('*')
                ->from('cptransactions')
                ->where(['id'=>$id])
                ->one();
        switch($optn){
            case 1://packageId
                return $myvals['packId'];
            case 2:
                return $myvals['payMethod'];
            case 3:
                return $myvals['amount'];
            default:
                return 0;
        }
    }
    
     /**
         *         $statusArr = array(
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
         */
    public function saveStatus($statusArr)
    {
        $session=Yii::$app->session;
       foreach($statusArr as $key=>$value){
           $session[$key]= $value;
       }
    }
    
    public function recallStatus()
    {
        $session=Yii::$app->session;
        $statusArr=array();
        $statusArr['status']= $session['status'];
        $statusArr['statusId']= $session['statusId'];
        $statusArr['trxId']= $session['trxId'];
        $statusArr['amountPaid']= $session['amountPaid'];
        $statusArr['amountReq']= $session['amountReq'];
        $statusArr['payerName']= $session['payerName'];
        $statusArr['phoneNo']= $session['phoneNo'];
        $statusArr['cpTrxId']= $session['cpTrxId'];
        $statusArr['channel']= $session['channel'];
        $statusArr['memberId']= $session['memberId'];
        $statusArr['ptype']= $session['ptype'];
        $statusArr['pMethod']= $session['pMethod'];
        $statusArr['packId']= $session['packId'];
        $statusArr['theDate']= $session['theDate'];
        return $statusArr;
    }
    
    public function clearInpaymentStatus()
    {
        $session = Yii::$app->session;
        $session['memberId']=null;
        $session['payMethod']=null;
        $session['ptype']=null;
        $session['package']=null;
        $session['amount']=null;
        $session['cpRecExists'] = null;
    }
    
    public function clearStatusSession()
    {
        $session=Yii::$app->session;
        
        $session['status']=null;
        $session['statusId']=null;
        $session['trxId']=null;
        $session['amountPaid']=null;
        $session['amountReq']=null;
        $session['payerName']=null;
        $session['phoneNo']=null;
        $session['cpTrxId']=null;
        $session['channel']=null;
        $session['memberId']=null;
        $session['ptype']=null;
        $session['pMethod']=null;
        $session['packId']=null;
        $session['theDate']=null;

    }
    
    public function getExchangeRate($currency /* Integer*/, $optn=1)
    {
        $qry = (new \yii\db\Query());
        $myvals=$qry->select('*')
                ->from('tbl_exchange_rates')
                ->where(['currency'=>$currency,'toDate'=>null])
                ->one(); 
        switch($optn){
            case 1:
                return $myvals['rate'];
        }
    }
    
    public function getCurrencyParts($currency /* Integer*/, $optn=1)
    {
        $qry = (new \yii\db\Query());
        $myvals=$qry->select('*')
                ->from('tbl_currencies')
                ->where(['id'=>$currency])
                ->one(); 
        switch($optn){
            case 1:
                return $myvals['ShortName'];
            case 2:
                return $myvals['currencyName'];
            case 3:
                return $myvals['Symbol'];
        }
    }
}
