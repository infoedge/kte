<?php

namespace backend\modules\reports\models;

use Yii;

/**
 * This is the model class for table "tblcycleearnings".
 *
 * @property int $id
 * @property int $member
 * @property string $earnDate
 * @property float $cycles
 * @property float $amount Amount earned in USD
 * @property string|null $calcMatchBonus when Matching Bonus was Calculated and transferred tblmatching
 * @property string|null $trxToWalletDate
 * @property int|null $trxToWalletBy
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property People $member0
 */
class Tblcycleearnings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcycleearnings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'earnDate', 'cycles', 'amount', 'recordBy', 'recordDate'], 'required'],
            [['member', 'trxToWalletBy', 'recordBy'], 'integer'],
            [['earnDate', 'calcMatchBonus', 'trxToWalletDate', 'recordDate'], 'safe'],
            [['cycles', 'amount'], 'number'],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
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
            'earnDate' => 'Earn Date',
            'cycles' => 'Cycles',
            'amount' => 'Amount',
            'calcMatchBonus' => 'Calc Match Bonus',
            'trxToWalletDate' => 'Trx To Wallet Date',
            'trxToWalletBy' => 'Trx To Wallet By',
            'recordBy' => 'Record By',
            'recordDate' => 'Record Date',
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
