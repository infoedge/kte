<?php

namespace frontend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "tblrankearnings".
 *
 * @property int $id
 * @property int $member
 * @property int $rankAchieved
 * @property float $amount Amount in USD ($)
 * @property string|null $cashInDate Date sent to wallet
 * @property int|null $cashInBy
 * @property string $recordDate
 * @property int $recordBy
 *
 * @property User $cashInBy0
 * @property People $member0
 * @property Ranks $rankAchieved0
 * @property User $recordBy0
 */
class Tblrankearnings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblrankearnings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'rankAchieved', 'amount', 'recordDate', 'recordBy'], 'required'],
            [['member', 'rankAchieved', 'cashInBy', 'recordBy'], 'integer'],
            [['amount'], 'number'],
            [['cashInDate', 'recordDate'], 'safe'],
            [['cashInBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['cashInBy' => 'id']],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
            [['rankAchieved'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['rankAchieved' => 'id']],
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
            'member' => Yii::t('app', 'Member'),
            'rankAchieved' => Yii::t('app', 'Rank Achieved'),
            'amount' => Yii::t('app', 'Amount'),
            'cashInDate' => Yii::t('app', 'Cash In Date'),
            'cashInBy' => Yii::t('app', 'Cash In By'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'recordBy' => Yii::t('app', 'Record By'),
        ];
    }

    /**
     * Gets query for [[CashInBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCashInBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'cashInBy']);
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
     * Gets query for [[RankAchieved0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRankAchieved0()
    {
        return $this->hasOne(Ranks::className(), ['id' => 'rankAchieved']);
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
