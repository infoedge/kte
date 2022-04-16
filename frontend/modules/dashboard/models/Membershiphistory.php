<?php

namespace frontend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "membershiphistory".
 *
 * @property int $id
 * @property int $memberId
 * @property int $packageId
 * @property int $status
 * @property int $rank
 * @property string|null $statusEndDate
 * @property string|null $expiryDate
 * @property string $dateStart
 * @property string|null $dateEnd
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property Sponsorship $member
 * @property Packages $package
 * @property Ranks $rank0
 * @property Statuses $status0
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
            [['memberId', 'packageId', 'status', 'rank', 'dateStart', 'recordBy', 'recordDate'], 'required'],
            [['memberId', 'packageId', 'status', 'rank', 'recordBy'], 'integer'],
            [['statusEndDate', 'expiryDate', 'dateStart', 'dateEnd', 'recordDate'], 'safe'],
            [['memberId'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsorship::className(), 'targetAttribute' => ['memberId' => 'member']],
            [['packageId'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['packageId' => 'id']],
            [['rank'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['rank' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => Statuses::className(), 'targetAttribute' => ['status' => 'id']],
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
            'status' => Yii::t('app', 'Status'),
            'rank' => Yii::t('app', 'Rank'),
            'statusEndDate' => Yii::t('app', 'Status End Date'),
            'expiryDate' => Yii::t('app', 'Expiry Date'),
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
     * Gets query for [[Rank0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRank0()
    {
        return $this->hasOne(Ranks::className(), ['id' => 'rank']);
    }

    /**
     * Gets query for [[Status0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(Statuses::className(), ['id' => 'status']);
    }
}
