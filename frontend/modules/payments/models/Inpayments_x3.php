<?php

namespace frontend\modules\payments\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\modules\payments\models\Packconfig;

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
 * @property People $member0
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
            [['member', 'package','ptype', 'amount', 'pdate', 'pMethod', 'transactionNo'], 'required'],
            [['member', 'package', 'ptype', 'package', 'recordBy','confirmBy'], 'integer'],
            [['amount'], 'number'],
            [['amount'],'in','range'=>$this->getAmountRange()/*[5,25,50]*/],
            //[['ptype'],'in','range'=>[4,5]],
            [['pdate', 'recordDate','confirmDate'], 'safe'],
            [['transactionNo'], 'string', 'max' => 30],
            [['transactionNo'], 'filter', 'filter' => [$this, 'changeUpperCase']],
            [['comments'], 'string', 'max' => 45],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => \frontend\modules\basic\models\People::className(), 'targetAttribute' => ['member' => 'id']],
            [['package'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['package' => 'id']],
            [['pMethod'], 'exist', 'skipOnError' => true, 'targetClass' => Paymethods::className(), 'targetAttribute' => ['pMethod' => 'id']],
            [['ptype'], 'exist', 'skipOnError' => true, 'targetClass' => Paymenttypes::className(), 'targetAttribute' => ['ptype' => 'id']],
        ];
    }

    /**
     * 
     * @param type $value
     * @return type uppercase of the string
     */
    public Function changeUpperCase($value){
        return strtoupper($value);
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
            'ptype' => Yii::t('app', 'Ptype'),
            'amount' => Yii::t('app', 'Amount'),
            'pdate' => Yii::t('app', 'Pdate'),
            'pMethod' => Yii::t('app', 'P Method'),
            'transactionNo' => Yii::t('app', 'Transaction No'),
            'confirmBy' => Yii::t('app', 'Confirmed By'),
            'confirmDate' => Yii::t('app', 'Confirm Date'),
            'comments' => Yii::t('app', 'Comments'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'recordBy' => Yii::t('app', 'Record By'),
        ];
    }
    
    /*public function scenarios()
    {
        return [
            'dataentry'=> ['member', 'ptype', 'amount', 'pdate', 'pMethod', 'transactionNo'],
            'confirmpay' => ['member', 'ptype', 'amount', 'pMethod', 'transactionNo','confirmDate','confirmedBy'],
        ];
    }*/

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
    
    public function getAmountRange()
    {
        $result = Packconfig::find()->distinct('amount')->all();
        return ArrayHelper::getColumn($result, 'amount');
    }
}
