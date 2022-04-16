<?php

namespace frontend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "wallet".
 *
 * @property int $id
 * @property int $member
 * @property string $fromTable
 * @property string $trxDate
 * @property int $trxMethod Bitcoin,mpesa,
 * @property string $trxId
 * @property int $trxDir Transaction direction: Out= -1; In= 1
 * @property float $amount
 * @property string $recordDate
 * @property int $recordBy
 *
 * @property People $member0
 */
class Wallet extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallet';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'fromTable', 'trxDate', 'trxMethod', 'trxId', 'amount'], 'required'],
            [['member', 'trxMethod', 'trxDir', 'recordBy'], 'integer'],
            [['trxDate', 'recordDate'], 'safe'],
            [['amount'], 'number'],
            [['fromTable'], 'string', 'max' => 45],
            [['trxId'], 'string', 'max' => 20],
            [['trxId'], 'unique'],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
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
            'fromTable' => Yii::t('app', 'From Table'),
            'trxDate' => Yii::t('app', 'Transaction Date'),
            'trxMethod' => Yii::t('app', 'Transaction Method'),
            'trxId' => Yii::t('app', 'Transaction ID'),
            'trxDir' => Yii::t('app', 'Transaction Direction'),
            'amount' => Yii::t('app', 'Amount ($)'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'recordBy' => Yii::t('app', 'Record By'),
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
}
