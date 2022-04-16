<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "membershiphistory".
 *
 * @property int $id
 * @property int $memberId
 * @property int $packageId
 * @property int $paymentId
 * @property string $dateStart
 * @property string|null $dateEnd
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property Sponsorship $member
 * @property Packages $package
 * @property Inpayments $payment
 */
class Membershiphistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'membershiphistory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['memberId', 'packageId', 'paymentId', 'dateStart', 'recordBy', 'recordDate'], 'required'],
            [['memberId', 'packageId', 'paymentId', 'recordBy'], 'integer'],
            [['dateStart', 'dateEnd', 'recordDate'], 'safe'],
            [['memberId'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsorship::className(), 'targetAttribute' => ['memberId' => 'member']],
            [['packageId'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['packageId' => 'id']],
            [['paymentId'], 'exist', 'skipOnError' => true, 'targetClass' => Inpayments::className(), 'targetAttribute' => ['paymentId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'memberId' => Yii::t('app', 'Member ID'),
            'packageId' => Yii::t('app', 'Package ID'),
            'paymentId' => Yii::t('app', 'Payment ID'),
            'dateStart' => Yii::t('app', 'Date Start'),
            'dateEnd' => Yii::t('app', 'Date End'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * Gets query for [[Member]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Sponsorship::className(), ['member' => 'memberId']);
    }

    /**
     * Gets query for [[Package]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackage()
    {
        return $this->hasOne(Packages::className(), ['id' => 'packageId']);
    }

    /**
     * Gets query for [[Payment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(Inpayments::className(), ['id' => 'paymentId']);
    }
}
