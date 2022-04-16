<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "rankshistory".
 *
 * @property int $id
 * @property int $memberId
 * @property int $rankId
 * @property string $fromDate
 * @property string|null $toDate
 * @property string $RecordDate
 * @property int $RecordBy
 * @property string|null $ChangedDate
 * @property int|null $ChangedBy
 *
 * @property Ranks $rank
 * @property Sponsorship $member
 */
class Rankshistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rankshistory';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'memberId', 'rankId', 'fromDate', 'RecordDate', 'RecordBy'], 'required'],
            [['id', 'memberId', 'rankId', 'RecordBy', 'ChangedBy'], 'integer'],
            [['fromDate', 'toDate', 'RecordDate', 'ChangedDate'], 'safe'],
            [['id'], 'unique'],
            [['rankId'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['rankId' => 'id']],
            [['memberId'], 'exist', 'skipOnError' => true, 'targetClass' => Sponsorship::className(), 'targetAttribute' => ['memberId' => 'id']],
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
            'rankId' => Yii::t('app', 'Rank ID'),
            'fromDate' => Yii::t('app', 'From Date'),
            'toDate' => Yii::t('app', 'To Date'),
            'RecordDate' => Yii::t('app', 'Record Date'),
            'RecordBy' => Yii::t('app', 'Record By'),
            'ChangedDate' => Yii::t('app', 'Changed Date'),
            'ChangedBy' => Yii::t('app', 'Changed By'),
        ];
    }

    /**
     * Gets query for [[Rank]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRank()
    {
        return $this->hasOne(Ranks::className(), ['id' => 'rankId']);
    }

    /**
     * Gets query for [[Member]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Sponsorship::className(), ['id' => 'memberId']);
    }
}
