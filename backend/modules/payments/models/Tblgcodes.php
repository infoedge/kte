<?php

namespace backend\modules\payments\models;

use Yii;

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
            [['code', 'memberGen', 'dateGen', 'amount', 'expiryDate', 'recordBy', 'recordDate'], 'required'],
            [['memberGen', 'walletId', 'retrieveBy', 'recordBy', 'changedBy'], 'integer'],
            [['dateGen', 'retrieveDate', 'expiryDate', 'recordDate', 'changedDate'], 'safe'],
            [['amount'], 'number'],
            [['code'], 'string', 'max' => 20],
            [['recipientEmail'], 'string', 'max' => 50],
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
            'id' => 'ID',
            'code' => 'Code',
            'memberGen' => 'Member Generating',
            'dateGen' => 'Date Generated',
            'amount' => 'Amount',
            'walletId' => 'Wallet ID',
            'recipientEmail' => 'Recipient Email',
            'retrieveDate' => 'Retrieve Date',
            'retrieveBy' => 'Retrieve By',
            'expiryDate' => 'Expiry Date',
            'recordBy' => 'Record By',
            'recordDate' => 'Record Date',
            'changedBy' => 'Changed By',
            'changedDate' => 'Changed Date',
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
}
