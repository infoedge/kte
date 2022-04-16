<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\payments\models;

use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use frontend\modules\payments\models\Packconfig;
use frontend\modules\payments\models\Tblgcodes;

/**
 * Description of Packregistration
 *
 * @author Apache1
 */
class Packregistration extends Model{
    public $member;//memberId
    public $package; 
    public $ptype;
    public $amount;
    public $pMethod;
    public $trxNo;
    public $recordBy;
    public $recordDate;
    public $msg;
    //public $comments;


    public function rules() {
        return [
            
            [[ 'amount', 'package','member', 'ptype','pMethod','trxNo'], 'required'],
            [['member', 'ptype','package','pMethod','recordBy',''], 'integer'],
            [['amount'], 'number'],
            [['amount'],'in','range'=>$this->getAmountRange()/*[5,25,50]*/],
            [['trxNo'], 'string', 'max' => 30],
            [['recordDate'], 'safe'],
            [['trxNo'], 'in', 'range'=>$this->getValidGcodes(),
                                            'when'=>function($model){return $this->pMethod=='5';},
                                            'whenClient'=>"$('#packregistration-pmethod').val()=='5';",
                                                    'message'=>'Invalid Gift Code'],
            [['trxNo'],'unique'],
            //[['comments'], 'string', 'max' => 45],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => \frontend\modules\basic\models\People::className(), 'targetAttribute' => ['member' => 'id']],
            [['pMethod'], 'exist', 'skipOnError' => true, 'targetClass' => Paymethods::className(), 'targetAttribute' => ['pMethod' => 'id']],
            [['ptype'], 'exist', 'skipOnError' => true, 'targetClass' => Paymenttypes::className(), 'targetAttribute' => ['ptype' => 'id']],
            [['package'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['package' => 'id']],
        
        ];
    }
    
    public function attributeLabels()
    {
        return [
           
            'member' => Yii::t('app', 'Member'),
            'ptype' => Yii::t('app', 'Payment For'),
            'package' => Yii::t('app', 'Package'),
            'amount' => Yii::t('app', 'Amount ($)'),
            
            'pMethod' => Yii::t('app', 'Payment Method'),
            'trxNo' => Yii::t('app', 'Transaction No'),
            //'comments' => Yii::t('app', 'Comments'),
            
        ];
    }
    
    public function keepValues(){
        $memberDetails = Yii::$app->memberdetails;
        $dbmodel = new Inpayments();
        $dbmodel->member= $this->member;
        $dbmodel->amount = $this->amount;
        $dbmodel->pdate = date('Y-m-d H:i::s');
        $dbmodel->pMethod = $this->pMethod;
        $dbmodel->package = $this->package;
        $dbmodel->ptype = $this->ptype;
        $dbmodel->transactionNo = $this->trxNo;
        $dbmodel->recordBy = Yii::$app->user->id;
        $dbmodel->recordDate = date('Y-m-d H:i::s');
        $dbmodel->save();
        if($dbmodel->pMethod==5){
            $memberDetails->updateWalletByCode($dbmodel->transactionNo,$dbmodel->recordDate);
        }
        
    }
    public function lookupValues($memberId,$trxType,$packId=null){
        //$dbmodel = new Packregistration();
        if (($model = Inpayments::find()->where([
            'member'=>$memberId,
            'package'=>$packId==null?'*':$packId,
            'ptype'=>$trxType,
            'confirmed'=>null,
            
            ])->one()) !== null) {
             
            $this->amount=$model->amount;
            $this->pMethod=$model->pMethod;
            $this->trxNo = $model->transactionNo;
            $this->recordBy = $model->recordBy;
            $this->recordDate = $model->recordDate;
            $this->msg='Payment NOT yet confirmed. Please wait a few minutes';
        }
            $this->member = $memberId;
            $this->package =$packId;
            $this->ptype =$trxType;
        return $model;
    }
    
    public function getAmountRange()
    {
        $result = Packconfig::find()->distinct('amount')->all();
        return ArrayHelper::getColumn($result, 'amount');
    }
    public function getValidGcodes(){
        $mygcodes = Tblgcodes::find()->where('expiryDate>:theDate',[':theDate'=>date('Y-m-d H:i:s')])->all();
        return ArrayHelper::getColumn($mygcodes, 'code');
        
    }

}
