<?php

namespace backend\modules\reports\models;

use Yii;

/**
 * This is the model class for table "tblmatching".
 *
 * @property int $id
 * @property int $member
 * @property int $rank
 * @property int $memberFrom
 * @property int $relLevel
 * @property float $amount
 * @property int|null $trxToWalletBy
 * @property string|null $trxToWalletDate
 * @property string $recordDate
 * @property int $recordBy
 *
 * @property People $member0
 * @property People $memberFrom0
 * @property Ranks $rank0
 */
class Tblmatching extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblmatching';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'rank', 'memberFrom', 'relLevel', 'amount', 'recordDate', 'recordBy'], 'required'],
            [['member', 'rank', 'memberFrom', 'relLevel', 'trxToWalletBy', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['trxToWalletDate', 'recordDate'], 'safe'],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
            [['memberFrom'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['memberFrom' => 'id']],
            [['rank'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['rank' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'member' => 'Member',
            'rank' => 'Rank',
            'memberFrom' => 'Member From',
            'relLevel' => 'Rel Level',
            'amount' => 'Amount',
            'trxToWalletBy' => 'Trx To Wallet By',
            'trxToWalletDate' => 'Trx To Wallet Date',
            'recordDate' => 'Record Date',
            'recordBy' => 'Record By',
        ];
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
     * Gets query for [[MemberFrom0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberFrom0()
    {
        return $this->hasOne(People::className(), ['id' => 'memberFrom']);
    }

    /**
     * Gets query for [[Rank0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRank0()
    {
        return $this->hasOne(Ranks::className(), ['id' => 'rank']);
    }
}
