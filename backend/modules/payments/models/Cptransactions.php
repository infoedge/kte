<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "cptransactions".
 *
 * @property int $id
 * @property int $memberId
 * @property int $trxId
 * @property int $packId
 * @property string $dateStart
 * @property float $amount
 * @property int|null $channel
 * @property string|null $bc_trx_id
 * @property string|null $trxNo
 * @property string|null $status
 * @property string|null $statusDate
 * @property string|null $address
 * @property string|null $dest_tag
 * @property int|null $confirms_needed
 *
 * @property People $member
 * @property Packages $pack
 * @property Paymenttypes $trx
 */
class Cptransactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cptransactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['memberId', 'trxId', 'packId', 'dateStart', 'amount'], 'required'],
            [['memberId', 'trxId', 'packId', 'channel', 'confirms_needed'], 'integer'],
            [['dateStart', 'statusDate'], 'safe'],
            [['amount'], 'number'],
            [['bc_trx_id'], 'string', 'max' => 100],
            [['trxNo', 'status'], 'string', 'max' => 45],
            [['address', 'dest_tag'], 'string', 'max' => 255],
            [['memberId'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['memberId' => 'id']],
            [['packId'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['packId' => 'id']],
            [['trxId'], 'exist', 'skipOnError' => true, 'targetClass' => Paymenttypes::className(), 'targetAttribute' => ['trxId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'memberId' => Yii::t('app', 'Member ID'),
            'trxId' => Yii::t('app', 'Trx ID'),
            'packId' => Yii::t('app', 'Pack ID'),
            'dateStart' => Yii::t('app', 'Date Start'),
            'amount' => Yii::t('app', 'Amount'),
            'channel' => Yii::t('app', 'Channel'),
            'bc_trx_id' => Yii::t('app', 'Bc Trx ID'),
            'trxNo' => Yii::t('app', 'Trx No'),
            'status' => Yii::t('app', 'Status'),
            'statusDate' => Yii::t('app', 'Status Date'),
            'address' => Yii::t('app', 'Address'),
            'dest_tag' => Yii::t('app', 'Dest Tag'),
            'confirms_needed' => Yii::t('app', 'Confirms Needed'),
        ];
    }

    /**
     * Gets query for [[Member]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(People::className(), ['id' => 'memberId']);
    }

    /**
     * Gets query for [[Pack]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPack()
    {
        return $this->hasOne(Packages::className(), ['id' => 'packId']);
    }

    /**
     * Gets query for [[Trx]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrx()
    {
        return $this->hasOne(Paymenttypes::className(), ['id' => 'trxId']);
    }
}
