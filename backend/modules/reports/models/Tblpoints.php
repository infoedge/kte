<?php

namespace backend\modules\reports\models;

use Yii;

/**
 * This is the model class for table "tblpoints".
 *
 * @property int $id
 * @property int $sponsor
 * @property int $memberFrom
 * @property int $bonusType
 * @property int $relLevel
 * @property float $points
 * @property string $recordDate
 * @property int $recordBy
 * @property string|null $cashInDate Date Transfered to wallet
 * @property int|null $CashInBy Transfered to wallet by whom
 *
 * @property Bonustypes $bonusType0
 * @property People $memberFrom0
 * @property People $sponsor0
 */
class Tblpoints extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblpoints';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sponsor', 'memberFrom', 'bonusType', 'relLevel', 'points', 'recordDate', 'recordBy'], 'required'],
            [['sponsor', 'memberFrom', 'bonusType', 'relLevel', 'recordBy', 'CashInBy'], 'integer'],
            [['points'], 'number'],
            [['recordDate', 'cashInDate'], 'safe'],
            [['bonusType'], 'exist', 'skipOnError' => true, 'targetClass' => Bonustypes::className(), 'targetAttribute' => ['bonusType' => 'id']],
            [['memberFrom'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['memberFrom' => 'id']],
            [['sponsor'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['sponsor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sponsor' => 'Sponsor',
            'memberFrom' => 'Member From',
            'bonusType' => 'Bonus Type',
            'relLevel' => 'Rel Level',
            'points' => 'Points',
            'recordDate' => 'Record Date',
            'recordBy' => 'Record By',
            'cashInDate' => 'Cash In Date',
            'CashInBy' => 'Cash In By',
        ];
    }

    /**
     * Gets query for [[BonusType0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBonusType0()
    {
        return $this->hasOne(Bonustypes::className(), ['id' => 'bonusType']);
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
     * Gets query for [[Sponsor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsor0()
    {
        return $this->hasOne(People::className(), ['id' => 'sponsor']);
    }
}
