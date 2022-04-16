<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "inpayments".
 *
 * @property int $id
 * @property int $member
 * @property int $package
 * @property int $ptype what Is Payment For?
 * @property float $amount in USD ($)
 * @property string $pdate
 * @property int $pMethod Which method was used to Pay
 * @property string $transactionNo
 * @property int|null $confirmBy
 * @property string|null $confirmDate
 * @property string|null $comments
 * @property string $recordDate
 * @property int $recordBy
 *
 * @property People $member0
 * @property Packages $package0
 * @property Paymethods $pMethod0
 * @property Paymenttypes $ptype0
 * @property Membershiphistory[] $membershiphistories
 */
class Inpayments extends \yii\db\ActiveRecord
{
    
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
            [['member', 'ptype','package' ,'amount', 'pdate', 'pMethod', 'transactionNo'], 'required'],
            [['member', 'ptype','package' ,'pMethod', 'recordBy','confirmBy'], 'integer'],
            [['amount'], 'number'],
            [['pdate', 'recordDate','confirmDate'], 'safe'],
            [['transactionNo'], 'string', 'max' => 30],
            [['comments'], 'string', 'max' => 45],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
            [['package'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['package' => 'id']],
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
            'package' => Yii::t('app', 'Package'),
            'ptype' => Yii::t('app', 'Payment Type'),
            'amount' => Yii::t('app', 'Amount($)'),
            'pdate' => Yii::t('app', 'Pay Date'),
            'pMethod' => Yii::t('app', 'Payment Method'),
            'transactionNo' => Yii::t('app', 'Transaction No'),
            'confirmBy' => Yii::t('app', 'Confirmed By'),
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
            'dataentry'=> ['member', 'ptype','package', 'amount', 'pdate', 'pMethod', 'transactionNo'],
            'confirmpay' => ['member', 'ptype','package', 'amount', 'pMethod', 'transactionNo','confirmDate','confirmBy'],
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
     * Gets query for [[Package0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackage0()
    {
        return $this->hasOne(Packages::className(), ['id' => 'package']);
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

    /**
     * Gets query for [[Membershiphistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershiphistories()
    {
        return $this->hasMany(Membershiphistory::className(), ['paymentId' => 'id']);
    }
}
