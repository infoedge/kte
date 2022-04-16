<?php

namespace frontend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "tblwithdrawal".
 *
 * @property int $id
 * @property int $member
 * @property int $withdrawalType
 * @property string $accountNo
 * @property float $amount
 * @property int $requestBy
 * @property string $requestDate
 * @property int|null $approvedBy
 * @property string|null $approvedDate
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property People $approvedBy0
 * @property User $recordBy0
 * @property People $requestBy0
 * @property Withdrawaltypes $withdrawalType0
 */
class Tblwithdrawal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblwithdrawal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'withdrawalType', 'accountNo', 'amount'], 'required'],
            [['member', 'withdrawalType', 'requestBy', 'approvedBy', 'recordBy'], 'integer'],
            [['amount'], 'number','min'=>Yii::$app->memberdetails->getAppConstant('minWalletWithdrawalAmount'),'message'=>'Minimum withdrawable amount is \$25'],
            [['amount'],'number','max'=>$this->getMaxWithdrawableAmount()],
            [['requestDate', 'approvedDate', 'recordDate'], 'safe'],
            [['accountNo'], 'string', 'max' => 45],
            [['approvedBy'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['approvedBy' => 'id']],
            [['recordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recordBy' => 'id']],
            [['requestBy'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['requestBy' => 'id']],
            [['withdrawalType'], 'exist', 'skipOnError' => true, 'targetClass' => Withdrawaltypes::className(), 'targetAttribute' => ['withdrawalType' => 'id']],
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
            'withdrawalType' => Yii::t('app', 'Withdraw To'),
            'accountNo' => Yii::t('app', 'Your Account No'),
            'amount' => Yii::t('app', 'Amount ($)'),
            'requestBy' => Yii::t('app', 'Request By'),
            'requestDate' => Yii::t('app', 'Request Date'),
            'approvedBy' => Yii::t('app', 'Approved By'),
            'approvedDate' => Yii::t('app', 'Approved Date'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * Gets query for [[ApprovedBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApprovedBy0()
    {
        return $this->hasOne(People::className(), ['id' => 'approvedBy']);
    }

    /**
     * Gets query for [[RecordBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecordBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'recordBy']);
    }

    /**
     * Gets query for [[RequestBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestBy0()
    {
        return $this->hasOne(People::className(), ['id' => 'requestBy']);
    }

    /**
     * Gets query for [[WithdrawalType0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWithdrawalType0()
    {
        return $this->hasOne(Withdrawaltypes::className(), ['id' => 'withdrawalType']);
    }
    public function getMaxWithdrawableAmount()
    {
        $memberDetails= Yii::$app->memberdetails;
        
        return $memberDetails->getWalletBal($this->member)/(1+($memberDetails->getAppConstant('commissionOnWithdrawal')/100));
    }
}
