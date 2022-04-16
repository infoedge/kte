<?php

namespace frontend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "sponsorship".
 *
 * @property int $id
 * @property int $member Refers to people table
 * @property int $status Active=2; Inactive=1;
 * @property int|null $membershipNo
 * @property int $parent Refers to people table
 * @property int $lft
 * @property int $rgt
 * @property int $sponsor Refers to people table
 * @property int|null $level Level WRT parent, Directly below parent is level 1
 * @property int|null $Rank Title name to be Displaye in chart.
 * @property int $RecordBy
 * @property string $RecordDate
 * @property int|null $ChangedBy
 * @property string|null $ChangedDate
 *
 * @property Inpayments[] $inpayments
 * @property Rankshistory[] $rankshistories
 * @property Scorecard[] $scorecards
 * @property Scorecard[] $scorecards0
 * @property User $changedBy
 * @property People $member0
 * @property People $parent0
 * @property Ranks $rank
 * @property User $recordBy
 * @property People $sponsor0
 * @property Statuses $status0
 */
class Sponsorship extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sponsorship';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'status', 'parent', 'lft', 'rgt', 'sponsor', 'RecordBy', 'RecordDate'], 'required'],
            [['member', 'status', 'membershipNo', 'parent', 'lft', 'rgt', 'sponsor', 'level', 'Rank', 'RecordBy', 'ChangedBy'], 'integer'],
            [['RecordDate', 'ChangedDate'], 'safe'],
            [['member'], 'unique'],
            [['ChangedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ChangedBy' => 'id']],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['parent' => 'id']],
            [['Rank'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['Rank' => 'id']],
            [['RecordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['RecordBy' => 'id']],
            [['sponsor'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['sponsor' => 'id']],
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
            'member' => Yii::t('app', 'Member'),
            'status' => Yii::t('app', 'Status'),
            'membershipNo' => Yii::t('app', 'Membership No'),
            'parent' => Yii::t('app', 'Parent'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'sponsor' => Yii::t('app', 'Sponsor'),
            'level' => Yii::t('app', 'Level'),
            'Rank' => Yii::t('app', 'Rank'),
            'RecordBy' => Yii::t('app', 'Record By'),
            'RecordDate' => Yii::t('app', 'Record Date'),
            'ChangedBy' => Yii::t('app', 'Changed By'),
            'ChangedDate' => Yii::t('app', 'Changed Date'),
        ];
    }

    /**
     * Gets query for [[Inpayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInpayments()
    {
        return $this->hasMany(Inpayments::className(), ['member' => 'member']);
    }

    /**
     * Gets query for [[Rankshistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRankshistories()
    {
        return $this->hasMany(Rankshistory::className(), ['memberId' => 'id']);
    }

    /**
     * Gets query for [[Scorecards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScorecards()
    {
        return $this->hasMany(Scorecard::className(), ['fromMember' => 'member']);
    }

    /**
     * Gets query for [[Scorecards0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScorecards0()
    {
        return $this->hasMany(Scorecard::className(), ['member' => 'member']);
    }

    /**
     * Gets query for [[ChangedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChangedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'ChangedBy']);
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
     * Gets query for [[Parent0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(People::className(), ['id' => 'parent']);
    }

    /**
     * Gets query for [[Rank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRank()
    {
        return $this->hasOne(Ranks::className(), ['id' => 'Rank']);
    }

    /**
     * Gets query for [[RecordBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecordBy()
    {
        return $this->hasOne(User::className(), ['id' => 'RecordBy']);
    }

    /**
     * Gets query for [[Sponsor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsor0()
    {
        return $this->hasOne(People::className(), ['id' => 'sponsor']);
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
