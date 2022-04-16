<?php

namespace backend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "tblmatching".
 *
 * @property int $id
 * @property int $member
 * @property int $rank
 * @property int $memberFrom
 * @property float $amount
 * @property string|null $recordDate
 * @property int|null $recordBy
 *
 * @property People $member0
 * @property People $memberFrom0
 * @property Ranks $rank0
 */
class Tblmatching extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblmatching';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'rank', 'memberFrom', 'amount'], 'required'],
            [['member', 'rank', 'memberFrom', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['recordDate'], 'safe'],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
            [['memberFrom'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['memberFrom' => 'id']],
            [['rank'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['rank' => 'id']],
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
            'rank' => Yii::t('app', 'Rank'),
            'memberFrom' => Yii::t('app', 'Member From'),
            'amount' => Yii::t('app', 'Amount'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'recordBy' => Yii::t('app', 'Record By'),
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
     * Gets query for [[MemberFrom0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberFrom0()
    {
        return $this->hasOne(People::className(), ['id' => 'memberFrom']);
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
}
