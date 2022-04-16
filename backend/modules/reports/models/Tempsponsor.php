<?php

namespace backend\modules\reports\models;

use Yii;

/**
 * This is the model class for table "tempsponsor".
 *
 * @property int $id
 * @property int $member
 * @property int $sponsor
 * @property int $parent
 * @property int $lft
 * @property int $parMethod Which method will be used to set parent
 * @property int $RecordBy
 * @property string $RecordDate
 *
 * @property User $member0
 * @property User $recordBy
 * @property Sponsorship $sponsor0
 */
class Tempsponsor extends \yii\db\ActiveRecord
{
    public $pstatus;
    public $sMemberNo;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tempsponsor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'sponsor', 'parent', 'lft', 'RecordBy', 'RecordDate'], 'required'],
            [['member', 'sponsor', 'parent', 'lft', 'parMethod', 'RecordBy'], 'integer'],
            [['RecordDate'], 'safe'],
            [['pstatus','sMemberNo'],'string'],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['member' => 'id']],
            [['RecordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['RecordBy' => 'id']],
            [['sponsor'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsorship::className(), 'targetAttribute' => ['sponsor' => 'membershipNo']],
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
            'sponsor' => 'Sponsor',
            'parent' => 'Parent',
            'lft' => 'Lft',
            'parMethod' => 'Par Method',
            'RecordBy' => 'Record By',
            'RecordDate' => 'Record Date',
        ];
    }

    /**
     * Gets query for [[Member0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember0()
    {
        return $this->hasOne(User::className(), ['id' => 'member']);
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
        return $this->hasOne(Sponsorship::className(), ['membershipNo' => 'sponsor']);
    }
    public function getProspectStatus()
    {
        return empty($this->member0->people->surname)?'No Personal Details':'Awaiting Payment';
    }
}
