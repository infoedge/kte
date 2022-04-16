<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "tblwithdrawal".
 *
 * @property int $id
 * @property int $member
 * @property int $withdrawalType
 * @property string $accountNo
 * @property string $withdrawalCode
 * @property float $amount
 * @property int $requestBy
 * @property string $requestDate
 * @property int $status
 * @property int|null $approvedBy
 * @property string|null $approvedDate
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property People $approvedBy0
 * @property People $member0
 * @property User $recordBy0
 * @property People $requestBy0
 * @property Withdrawalstatus $status0
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
            [['member', 'withdrawalType', 'accountNo', 'withdrawalCode', 'amount', 'requestBy', 'requestDate', 'recordBy', 'recordDate'], 'required'],
            [['member', 'withdrawalType', 'requestBy', 'status', 'approvedBy', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['requestDate', 'approvedDate', 'recordDate'], 'safe'],
            [['accountNo'], 'string', 'max' => 45],
            [['accountNo'], 'string', 'min' => 32,'when'=>function($model){return $model->withdrawalType==1;}],
            [['accountNo'], 'string', 'min' => 36,'when'=>function($model){return $model->withdrawalType==2;}],
            [['accountNo'], 'email','when'=>function($model){return $model->withdrawalType==3;}],
            [['withdrawalCode'], 'string', 'max' => 30],
            [['approvedBy'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['approvedBy' => 'id']],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
            [['recordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recordBy' => 'id']],
            [['requestBy'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['requestBy' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Withdrawalstatus::className(), 'targetAttribute' => ['status' => 'id']],
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
            'member' => Yii::t('app', 'Member Name'),
            'withdrawalType' => Yii::t('app', 'Withdrawal To'),
            'accountNo' => Yii::t('app', 'Account No'),
            'withdrawalCode' => Yii::t('app', 'Withdrawal Code'),
            'amount' => Yii::t('app', 'Amount($)'),
            'requestBy' => Yii::t('app', 'Request By'),
            'requestDate' => Yii::t('app', 'Request Date'),
            'status' => Yii::t('app', 'Status'),
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
     * Gets query for [[Member0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember0()
    {
        return $this->hasOne(People::className(), ['id' => 'member']);
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
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Withdrawalstatus::className(), ['id' => 'status']);
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
}
