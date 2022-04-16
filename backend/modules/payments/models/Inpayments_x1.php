<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "inpayments".
 *
 * @property int $id
 * @property int $member
 * @property int $ptype
 * @property float $amount in USD ($)
 * @property string $pdate
 * @property int $pMethod Which method was used to Pay
 * @property string $transactionNo
 * @property string|null $comments
 * @property string $recordDate
 * @property int $recordBy
 *
 * @property Sponsorship $member0
 * @property Paymenttypes $ptype0
 */
class Inpayments extends \yii\db\ActiveRecord
{
    public $package;
    public $confirmed;
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
            [['member', 'ptype', 'amount', 'pdate', 'pMethod', 'transactionNo'], 'required'],
            [['member', 'ptype', 'pMethod', 'recordBy','confirmedBy'], 'integer'],
            [['amount'], 'number'],
            [['pdate', 'recordDate','confirmDate'], 'safe'],
            [['transactionNo'], 'string', 'max' => 30],
            [['comments'], 'string', 'max' => 45],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => \frontend\modules\basic\models\People::className(), 'targetAttribute' => ['member' => 'id']],
            [['pMethod'], 'exist', 'skipOnError' => true, 'targetClass' => Paymethods::className(), 'targetAttribute' => ['pMethod' => 'id']],
            [['ptype'], 'exist', 'skipOnError' => true, 'targetClass' => Paymenttypes::className(), 'targetAttribute' => ['ptype' => 'id']],
            [['package'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['package' => 'id']],
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
            'ptype' => Yii::t('app', 'Pyment Type'),
            'amount' => Yii::t('app', 'Amount ($)'),
            'pdate' => Yii::t('app', 'Payment Date'),
            'pMethod' => Yii::t('app', 'Payment Method'),
            'transactionNo' => Yii::t('app', 'Transaction No'),
            'confirmedBy' => Yii::t('app', 'Confirmed By'),
            'confirmDate' => Yii::t('app', 'Confirm Date'),
            'comments' => Yii::t('app', 'Comments'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'recordBy' => Yii::t('app', 'Record By'),
        ];
    }
    
    /**
     * 
     * @return type
     */
    public function scenarios()
    {
        return [
            'dataentry'=> ['member', 'ptype', 'amount', 'pdate', 'pMethod', 'transactionNo'],
            'confirmpay' => ['member', 'ptype', 'amount', 'pMethod', 'transactionNo','confirmDate','confirmedBy'],
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
