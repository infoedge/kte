<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "tblpoints".
 *
 * @property int $id
 * @property int $sponsor
 * @property int $memberFrom
 * @property int $bonusType
 * @property float $points
 * @property string $recordDate Date Transfered to wallet
 * @property int $recordBy Transfered to wallet by whom
 * @property string|null $cashInDate
 * @property int|null $CashInBy
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
            [['sponsor', 'memberFrom', 'bonusType', 'points', 'recordDate', 'recordBy'], 'required'],
            [['sponsor', 'memberFrom', 'bonusType', 'recordBy', 'CashInBy'], 'integer'],
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
            'id' => Yii::t('app', 'ID'),
            'sponsor' => Yii::t('app', 'Sponsor'),
            'memberFrom' => Yii::t('app', 'Member From'),
            'bonusType' => Yii::t('app', 'Bonus Type'),
            'points' => Yii::t('app', 'Points'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'recordBy' => Yii::t('app', 'Record By'),
            'cashInDate' => Yii::t('app', 'Cash In Date'),
            'CashInBy' => Yii::t('app', 'Cash In By'),
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
