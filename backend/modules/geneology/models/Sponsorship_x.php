<?php

namespace backend\modules\genealogy\models;

use Yii;

/**
 * This is the model class for table "sponsorship".
 *
 * @property int $id
 * @property int $child Refers to people table
 * @property int $status Active=1; Inactive=0;
 * @property int|null $sponsorshipNo
 * @property int $parent Refers to people table
 * @property int $sponsor Refers to people table
 * @property int|null $level Level WRT parent, Directly below parent is level 1
 * @property string|null $Rank Title name to be Displaye in chart.
 * @property int $RecordBy
 * @property string $RecordDate
 * @property int|null $ChangedBy
 * @property string|null $ChangedDate
 *
 * @property User $changedBy
 * @property People $child0
 * @property People $parent0
 * @property User $recordBy
 * @property People $sponsor0
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
            [['child', 'parent', 'sponsor', 'RecordBy', 'RecordDate'], 'required'],
            [['child', 'status', 'sponsorshipNo', 'parent', 'sponsor', 'level', 'RecordBy', 'ChangedBy'], 'integer'],
            [['RecordDate', 'ChangedDate'], 'safe'],
            [['Rank'], 'string', 'max' => 45],
            [['child'], 'unique'],
            [['ChangedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['ChangedBy' => 'id']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['child' => 'id']],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['parent' => 'id']],
            [['RecordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['RecordBy' => 'id']],
            [['sponsor'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['sponsor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'child' => Yii::t('app', 'Member Name'),
            'status' => Yii::t('app', 'Status'),
            'sponsorshipNo' => Yii::t('app', 'Member No'),
            'parent' => Yii::t('app', 'Parent  Name'),
            'sponsor' => Yii::t('app', 'Sponsor\'s Name'),
            'level' => Yii::t('app', 'Level'),
            'Rank' => Yii::t('app', 'Rank'),
            'RecordBy' => Yii::t('app', 'Record By'),
            'RecordDate' => Yii::t('app', 'Record Date'),
            'ChangedBy' => Yii::t('app', 'Changed By'),
            'ChangedDate' => Yii::t('app', 'Changed Date'),
        ];
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
     * Gets query for [[Child0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(People::className(), ['id' => 'child']);
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
    public function getStatuses0()
    {
        return $this->hasOne(Statuses::className(), ['status' => 'id']);
    }
}
