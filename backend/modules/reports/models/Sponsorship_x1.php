<?php

namespace backend\modules\reports\models;

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
 * @property int $position 0=root;1=left; 2=right
 * @property int $sponsor Refers to people table
 * @property int|null $level Level WRT parent, Directly below parent is level 1
 * @property int|null $Rank Title name to be Displaye in chart.
 * @property int $prefPosition Preferred Position: 0=auto; 1=Left; 2=Right
 * @property string|null $prefix
 * @property int $RecordBy
 * @property string $RecordDate
 * @property int|null $ChangedBy
 * @property string|null $ChangedDate
 *
 * @property Membershiphistory[] $membershiphistories
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
            [['member', 'status', 'parent', 'lft', 'rgt', 'position', 'sponsor', 'RecordBy', 'RecordDate'], 'required'],
            [['member', 'status', 'membershipNo', 'parent', 'lft', 'rgt', 'position', 'sponsor', 'level', 'Rank', 'prefPosition', 'RecordBy', 'ChangedBy'], 'integer'],
            [['RecordDate', 'ChangedDate','memberName'], 'safe'],
            [['prefix'], 'string', 'max' => 20],
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
            'id' => 'ID',
            'member' => 'Member',
            'status' => 'Status',
            'membershipNo' => 'Membership No',
            'parent' => 'Parent',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'position' => 'Position',
            'sponsor' => 'Sponsor',
            'level' => 'Level',
            'Rank' => 'Rank',
            'prefPosition' => 'Pref Position',
            'prefix' => 'Prefix',
            'RecordBy' => 'Record By',
            'RecordDate' => 'Record Date',
            'ChangedBy' => 'Changed By',
            'ChangedDate' => 'Changed Date',
        ];
    }

    /**
     * Gets query for [[Membershiphistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershiphistories()
    {
        return $this->hasMany(Membershiphistory::className(), ['memberId' => 'member']);
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
    public function getPosition0()
    {
        return $this->position==0?'Root':($this->position==1?'Left':'Right');
    }
}
