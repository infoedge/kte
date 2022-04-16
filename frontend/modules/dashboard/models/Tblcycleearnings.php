<?php

namespace frontend\modules\dashboard\models;

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
            [['member', 'earnDate', 'cycles', 'amount'], 'required'],
            [['member', 'trxToWalletBy'], 'integer'],
            [['earnDate', 'calcMatchBonus', 'trxToWalletDate'], 'safe'],
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
            'id' => Yii::t('app', 'ID'),
            'member' => Yii::t('app', 'Member'),
            'earnDate' => Yii::t('app', 'Earn Date'),
            'cycles' => Yii::t('app', 'Cycles'),
            'amount' => Yii::t('app', 'Amount'),
            'calcMatchBonus' => Yii::t('app', 'Calc Match Bonus'),
            'trxToWalletDate' => Yii::t('app', 'Trx To Wallet Date'),
            'trxToWalletBy' => Yii::t('app', 'Trx To Wallet By'),
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
