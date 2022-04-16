<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "scorecard".
 *
 * @property int $id
 * @property int $member
 * @property int $fromMember
 * @property int $transactionType
 * @property int $points
 * @property string $trxDate
 *
 * @property Sponsorship $fromMember0
 * @property Sponsorship $member0
 * @property Pointtrxtypes $transactionType0
 */
class Scorecard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'scorecard';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'fromMember', 'transactionType', 'points', 'trxDate'], 'required'],
            [['member', 'fromMember', 'transactionType', 'points'], 'integer'],
            [['trxDate'], 'safe'],
            [['fromMember'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsorship::className(), 'targetAttribute' => ['fromMember' => 'member']],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsorship::className(), 'targetAttribute' => ['member' => 'member']],
            [['transactionType'], 'exist', 'skipOnError' => true, 'targetClass' => Pointtrxtypes::className(), 'targetAttribute' => ['transactionType' => 'id']],
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
            'fromMember' => Yii::t('app', 'From Member'),
            'transactionType' => Yii::t('app', 'Transaction Type'),
            'points' => Yii::t('app', 'Points'),
            'trxDate' => Yii::t('app', 'Trx Date'),
        ];
    }

    /**
     * Gets query for [[FromMember0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFromMember0()
    {
        return $this->hasOne(Sponsorship::className(), ['member' => 'fromMember']);
    }

    /**
     * Gets query for [[Member0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember0()
    {
        return $this->hasOne(Sponsorship::className(), ['member' => 'member']);
    }

    /**
     * Gets query for [[TransactionType0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransactionType0()
    {
        return $this->hasOne(Pointtrxtypes::className(), ['id' => 'transactionType']);
    }
}
