<?php

namespace frontend\modules\payments\models;

use Yii;
use frontend\modules\payments\models\User;
use yii\helpers\ArrayHelper;
use frontend\modules\payments\models\People;
use yii\helpers\Url;

/**
 * This is the model class for table "tblgcodes".
 *
 * @property int $id
 * @property string $code
 * @property int $memberGen
 * @property string $dateGen
 * @property float $amount
 * @property int|null $walletId
 * @property string|null $recipientEmail
 * @property string|null $retrieveDate
 * @property int|null $retrieveBy
 * @property string $expiryDate
 * @property int $recordBy
 * @property string $recordDate
 * @property int|null $changedBy
 * @property string|null $changedDate
 *
 * @property People $retrieveBy0
 * @property User $changedBy0
 * @property People $memberGen0
 * @property User $recordBy0
 * @property Wallet $wallet
 */
class Tblgcodes extends \yii\db\ActiveRecord
{
    public $packconfigId;
    //public $recipientEmail;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblgcodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['packconfigId'], 'required'],
            [['memberGen', 'walletId', 'retrieveBy', 'recordBy', 'changedBy','packconfigId'], 'integer'],
            [['dateGen', 'retrieveDate', 'expiryDate', 'recordDate', 'changedDate'], 'safe'],
            [['amount'], 'number'],
            [['recipientEmail'],'email'],
            [['recipientEmail'],'in','range'=> $this->listUsersNotYetMembers(),'when'=>function($model){return !empty($model->recipientEmail);}],
            [['code'], 'string', 'max' => 20],
            [['code'], 'unique'],
            [['retrieveBy'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['retrieveBy' => 'id']],
            [['changedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['changedBy' => 'id']],
            [['memberGen'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['memberGen' => 'id']],
            [['recordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recordBy' => 'id']],
            [['walletId'], 'exist', 'skipOnError' => true, 'targetClass' => Wallet::className(), 'targetAttribute' => ['walletId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Gift Code No'),
            'memberGen' => Yii::t('app', 'Member Gen'),
            'dateGen' => Yii::t('app', 'Date Gen'),
            'amount' => Yii::t('app', 'Gift Code Type'),
            'packconfigId' => Yii::t('app', 'Gift Code Type'),
            'walletId' => Yii::t('app', 'Wallet ID'),
            'retrivedate' => Yii::t('app', 'Retrivedate'),
            'retrieveBy' => Yii::t('app', 'Recipient'),
            'recipientEmail' => Yii::t('app', 'Recipient Email/ Username'),
            'expiryDate' => Yii::t('app', 'Expiry Date'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'changedBy' => Yii::t('app', 'Changed By'),
            'changedDate' => Yii::t('app', 'Changed Date'),
        ];
    }

    /**
     * Gets query for [[RetrieveBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetrieveBy0()
    {
        return $this->hasOne(People::className(), ['id' => 'retrieveBy']);
    }

    /**
     * Gets query for [[ChangedBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChangedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'changedBy']);
    }

    /**
     * Gets query for [[MemberGen0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberGen0()
    {
        return $this->hasOne(People::className(), ['id' => 'memberGen']);
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
     * Gets query for [[Wallet]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWallet()
    {
        return $this->hasOne(Wallet::className(), ['id' => 'walletId']);
    }
    public function sendEmail($memberId,$gcId)
    {
        $userDetails = Yii::$app->userdetails;
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailGcGenerate-html', 'text' => 'emailGcGenerate-text'],
                ['memberId' => $memberId,'gcId'=> $gcId]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($userDetails->getUserParts($memberId,2))
            ->setSubject('Gift Code Successfully Generated @ '. Yii::$app->name)
            ->send();
    }
    public function sendGcRecipientEmail($sponsorId,$gcId)
    {
        
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailGctoRecipient-html', 'text' => 'emailGctoRecipient-text'],
                ['memberId' => $sponsorId,'gcId'=> $gcId]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->recipientEmail)
            ->setSubject('Gift Code From ' . Yii::$app->name)
            ->send();
    }
    
    public function listUsersNotYetMembers($optn=1,$recipientEmail='')
    {
        $myqry = (new yii\db\Query())
                ->select('*')
                ->from('people p')
                ->leftJoin('user u', 'u.peopleId = p.id')
                ->leftJoin('membershiphistory h', 'h.memberId = p.id')
                ->where(['h.id'=>null]);
        switch($optn)
        {
            case 1:
                $result = $myqry->all();
                return ArrayHelper::getColumn($result,'email');
            case 2:
                return  $myqry->where(['username'=>$recipientEmail])->one();
        }
        
    }
}
