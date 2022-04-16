<?php

namespace backend\modules\reports\models;

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
 * @property int|null $confirmed 1=Yes; 0=No
 * @property int|null $confirmBy
 * @property string|null $confirmDate
 * @property string|null $comments
 * @property string $recordDate
 * @property int $recordBy
 *
 * @property Failedpayreasons[] $failedpayreasons
 * @property People $member0
 * @property Packages $package0
 * @property Paymethods $pMethod0
 * @property Paymenttypes $ptype0
 */
class Inpayments extends \yii\db\ActiveRecord
{
    public $GoldRegCountTot;
    public $GoldRegAmtTot ;
    public $GoldSubsCountTot ;
    public $GoldSubsAmtTot;
    public $DiamondRegCountTot;
    public $DiamondRegAmtTot;
    public $DiamondUpgCountTot;
    public $DiamondUpgAmtTot;
    public $DiamondSubsCountTot;
    public $DiamondSubsAmtTot;
    public $TotCountTot;
    public $TotAmtTot;
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
            [['member', 'package', 'ptype', 'amount', 'pdate', 'pMethod', 'transactionNo', 'recordDate', 'recordBy'], 'required'],
            [['member', 'package', 'ptype', 'pMethod', 'confirmed', 'confirmBy', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['pdate', 'confirmDate', 'recordDate'], 'safe'],
            [['transactionNo'], 'string', 'max' => 30],
            [['comments'], 'string', 'max' => 255],
            [['transactionNo'], 'unique'],
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
            'id' => 'ID',
            'member' => 'Member',
            'package' => 'Package',
            'ptype' => 'Ptype',
            'amount' => 'Amount',
            'pdate' => 'Pdate',
            'pMethod' => 'P Method',
            'transactionNo' => 'Transaction No',
            'confirmed' => 'Confirmed',
            'confirmBy' => 'Confirm By',
            'confirmDate' => 'Confirm Date',
            'comments' => 'Comments',
            'recordDate' => 'Record Date',
            'recordBy' => 'Record By',
        ];
    }

    /**
     * Gets query for [[Failedpayreasons]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFailedpayreasons()
    {
        return $this->hasMany(Failedpayreasons::className(), ['inpaymentId' => 'id']);
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
    
    public function getShowDailyDayCount()
    {
        return Yii::$app->db
                ->createCommand('SELECT COUNT(DISTINCT Date(pdate)) FROM inpayments')
                ->queryScalar();
    }
    
    public function getPackageName()
    {
        return $this->package0->packName;
    }
    
    public function getOverallTotals()
    {
        $myTotals = Yii::$app->db
                ->createCommand('SELECT Date(pdate) AS JoinDate, 
                    SUM(CASE WHEN package=1 AND ptype=1 THEN 1 ELSE 0 END) as GoldRegCount, 
                    SUM(CASE WHEN package=1 AND ptype=1 THEN amount ELSE 0 End) as GoldRegAmt,
                    SUM(CASE WHEN package=1 AND ptype=2 THEN 1 ELSE 0 END) as GoldSubsCount, 
                    SUM(CASE WHEN package=1 AND ptype=2 THEN amount ELSE 0 End) as GoldSubsAmt,
                    SUM(CASE WHEN package=2 AND ptype=1 THEN 1 ELSE 0 END) as DiamondRegCount, 
                    SUM(CASE WHEN package=2 AND ptype=1 THEN amount ELSE 0 End) as DiamondRegAmt,
                    SUM(CASE WHEN package=2 AND ptype=3 THEN 1 ELSE 0 END) as DiamondUpgCount, 
                    SUM(CASE WHEN package=2 AND ptype=3 THEN amount ELSE 0 End) as DiamondUpgAmt,
                    SUM(CASE WHEN package=2 AND ptype=2 THEN 1 ELSE 0 END) as DiamondSubsCount, 
                    SUM(CASE WHEN package=2 AND ptype=2 THEN amount ELSE 0 End) as DiamondSubsAmt,
                    SUM( 1 ) as TotCount, 
                    SUM( amount) as TotAmt
                    from inpayments where 1')
                ->queryOne();
        $this->GoldRegCountTot = $myTotals['GoldRegCount'];
        $this->GoldRegAmtTot = $myTotals['GoldRegAmt'];
        $this->GoldSubsCountTot = $myTotals['GoldSubsCount'];
        $this->GoldSubsAmtTot = $myTotals['GoldSubsAmt'];
        $this->DiamondRegCountTot = $myTotals['DiamondRegCount'];
        $this->DiamondRegAmtTot = $myTotals['DiamondRegAmt'];
        $this->DiamondUpgCountTot = $myTotals['DiamondUpgCount'];
        $this->DiamondUpgAmtTot = $myTotals['DiamondUpgAmt'];
        $this->DiamondSubsCountTot = $myTotals['DiamondSubsCount'];
        $this->DiamondSubsAmtTot = $myTotals['DiamondSubsAmt'];
        $this->TotCountTot = $myTotals['TotCount'];
        $this->TotAmtTot = $myTotals['TotAmt'];
    }
}
