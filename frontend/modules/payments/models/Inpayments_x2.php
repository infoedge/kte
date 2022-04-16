<?php

namespace frontend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "inpayments".
 *
 * @property int $id
 * @property int $member
 * @property int $ptype what Is Payment For?
 * @property float $amount in USD ($)
 * @property string $pdate
 * @property int $pMethod Which method was used to Pay
 * @property string $transactionNo
 * @property string|null $comments
 * @property string $recordDate
 * @property int $recordBy
 *
 * @property Sponsorship $member0
 * @property Paymethods $pMethod0
 * @property Paymenttypes $ptype0
 */
class Inpayments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inpayments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'ptype', 'amount', 'pdate', 'pMethod', 'transactionNo', 'recordDate', 'recordBy'], 'required'],
            [['member', 'ptype', 'pMethod', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['pdate', 'recordDate'], 'safe'],
            [['transactionNo'], 'string', 'max' => 30],
            [['comments'], 'string', 'max' => 45],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsorship::className(), 'targetAttribute' => ['member' => 'member']],
            [['pMethod'], 'exist', 'skipOnError' => true, 'targetClass' => Paymethods::className(), 'targetAttribute' => ['pMethod' => 'id']],
            [['ptype'], 'exist', 'skipOnError' => true, 'targetClass' => Paymenttypes::className(), 'targetAttribute' => ['ptype' => 'id']],
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
            'ptype' => Yii::t('app', 'Ptype'),
            'amount' => Yii::t('app', 'Amount'),
            'pdate' => Yii::t('app', 'Pdate'),
            'pMethod' => Yii::t('app', 'P Method'),
            'transactionNo' => Yii::t('app', 'Transaction No'),
            'comments' => Yii::t('app', 'Comments'),
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
        return $this->hasOne(Sponsorship::className(), ['member' => 'member']);
    }

    /**
     * Gets query for [[PMethod0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPMethod0()
    {
        return $this->hasOne(Paymethods::className(), ['id' => 'pMethod']);
    }

    /**
     * Gets query for [[Ptype0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPtype0()
    {
        return $this->hasOne(Paymenttypes::className(), ['id' => 'ptype']);
    }
}
