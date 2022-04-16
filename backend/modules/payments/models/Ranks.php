<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "ranks".
 *
 * @property int $id
 * @property string $rankName
 * @property float $advBonus
 *
 * @property Membershiphistory[] $membershiphistories
 * @property Referralbonusconfig[] $referralbonusconfigs
 * @property Sponsorship[] $sponsorships
 * @property Tblmatching[] $tblmatchings
 */
class Ranks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ranks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rankName'], 'required'],
            [['advBonus'], 'number'],
            [['rankName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'rankName' => Yii::t('app', 'Rank Name'),
            'advBonus' => Yii::t('app', 'Adv Bonus'),
        ];
    }

    /**
     * Gets query for [[Membershiphistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershiphistories()
    {
        return $this->hasMany(Membershiphistory::className(), ['rank' => 'id']);
    }

    /**
     * Gets query for [[Referralbonusconfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReferralbonusconfigs()
    {
        return $this->hasMany(Referralbonusconfig::className(), ['sRank' => 'id']);
    }

    /**
     * Gets query for [[Sponsorships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorships()
    {
        return $this->hasMany(Sponsorship::className(), ['Rank' => 'id']);
    }

    /**
     * Gets query for [[Tblmatchings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblmatchings()
    {
        return $this->hasMany(Tblmatching::className(), ['rank' => 'id']);
    }
}
