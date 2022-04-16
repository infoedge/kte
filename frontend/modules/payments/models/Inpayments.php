<?php

namespace frontend\modules\payments\models;

use Yii;
use yii\helpers\ArrayHelper;

use frontend\modules\payments\models\Packconfig;
use frontend\modules\payments\models\Tblgcodes;
use frontend\modules\payments\models\Cptransactions;

/**
 * This is the model class for table "inpayments".
 *
 * @property int $id
 * @property int $member
 * @property int $package
 * @property int $ptype what Is Payment For?
 * @property float $amount in USD ($)
 * @property string $pdate
 * @property int $pMethod Which method was used to Pay
 * @property string $transactionNo
 * @property int|null $confirmed 1=Yes; 0=No
 * @property int|null $confirmBy
 * @property string|null $confirmDate
 * @property string|null $comments
 * @property string $recordDate
 * @property int $recordBy
 *
 * @property Failedpayreasons[] $failedpayreasons
 * @property People $member0
 * @property Packages $package0
 * @property Paymethods $pMethod0
 * @property Paymenttypes $ptype0
 */
class Inpayments extends \yii\db\ActiveRecord
{
    public $cpRecExists;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inpayments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'package', 'ptype', 'amount', 'pMethod'], 'required'],
            [['member', 'package', 'ptype', 'pMethod', 'confirmed', 'confirmBy', 'recordBy','cpRecExists'], 'integer'],
            [['amount'], 'number'],
            [['pdate', 'confirmDate', 'recordDate'], 'safe'],
            
            [['transactionNo'], 'unique'],
            [['transactionNo'], 'string', 'max' => 30],
            [['transactionNo'],'in','range'=> $this->getValidGcodes(),'when'=>function($model){return $model->pMethod==5;},'message'=>'Invalid Transaction No'],
            //[['transactionNo'],'in','range'=> $this->getValidBcodes(),'when'=>function($model){return $model->pMethod==4;},'message'=>'Invalid Transaction No'],
            //[['transactionNo'],'string','min'=>13,'when'=>function($model){return $model->pMethod==5;},'message'=>'Invalid Transaction No'],
            //[['transactionNo'],'string','min'=>26,'when'=>function($model){return $model->pMethod==4;},'message'=>'Invalid Transaction No'],
            
            [['amount'],'in','range'=>$this->getAmountRange()],
            [['cpRecExists'],'in','range'=>[0,1]],
            [['comments'], 'string', 'max' => 255],
            
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
            [['package'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['package' => 'id']],
            [['pMethod'], 'exist', 'skipOnError' => true, 'targetClass' => Paymethods::className(), 'targetAttribute' => ['pMethod' => 'id']],
            [['ptype'], 'exist', 'skipOnError' => true, 'targetClass' => Paymenttypes::className(), 'targetAttribute' => ['ptype' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member' => Yii::t('app', 'Member'),
            'package' => Yii::t('app', 'Package'),
            'ptype' => Yii::t('app', 'Payment Type'),
            'amount' => Yii::t('app', 'Amount'),
            'pdate' => Yii::t('app', 'Payment Date'),
            'pMethod' => Yii::t('app', 'Payment Method'),
            'transactionNo' => Yii::t('app', 'Transaction No'),
            'confirmBy' => Yii::t('app', 'Confirmed By'),
            'confirmDate' => Yii::t('app', 'Confirm Date'),
            'comments' => Yii::t('app', 'Comments'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'recordBy' => Yii::t('app', 'Record By'),
            'cpRecExists' => Yii::t('app', 'Bitcoin Record Exists?'),
        ];
    }

    /**
     * Gets query for [[Failedpayreasons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFailedpayreasons()
    {
        return $this->hasMany(Failedpayreasons::className(), ['inpaymentId' => 'id']);
    }

    /**
     * Gets query for [[Member0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember0()
    {
        return $this->hasOne(People::className(), ['id' => 'member']);
    }

    /**
     * Gets query for [[Package0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackage0()
    {
        return $this->hasOne(Packages::className(), ['id' => 'package']);
    }

    /**
     * Gets query for [[PMethod0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPMethod0()
    {
        return $this->hasOne(Paymethods::className(), ['id' => 'pMethod']);
    }

    /**
     * Gets query for [[Ptype0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPtype0()
    {
        return $this->hasOne(Paymenttypes::className(), ['id' => 'ptype']);
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
    public function lookupValues($memberId,$trxType=null,$packId=null){
        $this->member = $memberId;
        //$dbmodel = new Packregistration();
        if (!empty(($model = Inpayments::find()->where([
            'member'=>$memberId,
            'package'=>$packId==null?'':$packId,
            'ptype'=>$trxType,
            'confirmed'=>null,
            
            ])->one()) !== null)) {
            
            $this->package =$packId;
            $this->ptype =$trxType;
            $this->amount=$model->amount;
            $this->pMethod=$model->pMethod;
            $this->trxNo = $model->transactionNo;
            $this->recordBy = $model->recordBy;
            $this->recordDate = $model->recordDate;
            $this->msg='Payment NOT yet confirmed. Please wait a few minutes';
        }
            
        return $model;
    }
    public function sendMemConfirmEmail($memberid)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailMemConfirm-html', 'text' => 'emailMemConfirm-text'],
                ['memberid' => $memberid]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->userdetails->getUserParts($memberid,2))
            ->setSubject('Account registration  confirmation at ' . Yii::$app->name)
            ->send();
    }
    public function sendSponsorDlEmail($memberid)
    {
        $sponsorId = Yii::$app->memberdetails->getMemberPartsUsingPeopleId($memberid,3);
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailDlWelcome-html', 'text' => 'emailDlWelcome-text'],
                ['memberid' => $memberid]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->userdetails->getUserParts($sponsorId,2))
            ->setSubject(' A New Member in Your Team at ' . Yii::$app->name)
            ->send();
    }
//    $model->sendMemUpgradeEmail($memberId);
    public function sendMemUpgradeEmail($memberid)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailMemUpgrade-html', 'text' => 'emailMemUpgrade-text'],
                ['memberid' => $memberid]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->userdetails->getUserParts($memberid,2))
            ->setSubject('Account Upgrade  Confirmation at ' . Yii::$app->name)
            ->send();
    }
//    $model->sendSponsorupgradeEmail($memberId);
    public function sendSponsorUpgradeEmail($memberid)
    {
        $sponsorId = Yii::$app->memberdetails->getMemberPartsUsingPeopleId($memberid,3);
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailSponsorUpgrade-html', 'text' => 'emailSponsorUpgrade-text'],
                ['memberid' => $memberid]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->userdetails->getUserParts($sponsorId,2))
            ->setSubject(' A Member in Your Team at ' . Yii::$app->name.' has Upgraded')
            ->send();
    }
    public function getFullName(){
        return $this->member0->firstName.' '.$this->member0->surname;
    }
    
    public function getPackageName()
    {
        return $this->package0->packName;
    }
    
}
