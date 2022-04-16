<?php

namespace frontend\modules\payments\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tblfundstransfer".
 *
 * @property int $id
 * @property string $fundsTrxCode
 * @property int $memberFrom
 * @property float $amount
 * @property string $dateGen
 * @property int $memberTo
 * @property string $fundsRcvCode
 * @property string|null $dateAccepted
 * @property int $recordBy
 * @property string $recordDate
 * @property int|null $changedby
 * @property string|null $changedDate
 *
 * @property User $changedby0
 * @property People $memberFrom0
 * @property People $memberTo0
 * @property User $recordBy0
 */
class Tblfundstransfer extends \yii\db\ActiveRecord
{
    public $sendMemberNo;
    public $commissionCode;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblfundstransfer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sendMemberNo', 'amount'], 'required'],
            [['memberFrom', 'memberTo', 'recordBy', 'changedby','sendMemberNo'], 'integer'],
            [['amount'], 'number'],
            [['dateGen', 'dateAccepted', 'recordDate', 'changedDate'], 'safe'],
            [['fundsTrxCode', 'fundsRcvCode','commissionCode'], 'string', 'max' => 20],
            [['fundsTrxCode'], 'unique'],
            [['fundsRcvCode'], 'unique'],
            //[['sendMemberNo']'in','range'=>],
            [['changedby'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['changedby' => 'id']],
            [['memberFrom'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['memberFrom' => 'id']],
            [['memberTo'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['memberTo' => 'id']],
            [['recordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recordBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fundsTrxCode' => Yii::t('app', 'Funds Trx Code'),
            'memberFrom' => Yii::t('app', 'Member From'),
            'amount' => Yii::t('app', 'Amount ($)'),
            'dateGen' => Yii::t('app', 'Date Gen'),
            'memberTo' => Yii::t('app', 'Transfer To (Membership #)'),
            'sendMemberNo' => Yii::t('app', 'Transfer To (Membership No)'),
            'fundsRcvCode' => Yii::t('app', 'Funds Rcv Code'),
            'dateAccepted' => Yii::t('app', 'Date Accepted'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'changedby' => Yii::t('app', 'Changedby'),
            'changedDate' => Yii::t('app', 'Changed Date'),
        ];
    }
    
    /*public function validateMembershipno($attribute, $params, $validator)
    {
        $memberDetails = Yii::$app->memberdetails;
        if($memberDetails->getAllLeaves($attribute,,4);
    }*/

    /**
     * Gets query for [[Changedby0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChangedby0()
    {
        return $this->hasOne(User::className(), ['id' => 'changedby']);
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
     * Gets query for [[MemberTo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberTo0()
    {
        return $this->hasOne(People::className(), ['id' => 'memberTo']);
    }

    /**
     * Gets query for [[RecordBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecordBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'recordBy']);
    }
}
