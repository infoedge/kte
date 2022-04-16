<?php

namespace backend\modules\genealogy\models;

use Yii;

/**
 * This is the model class for table "ranks".
 *
 * @property int $id
 * @property string $rankName
 *
 * @property Rankshistory[] $rankshistories
 * @property Sponsorship[] $sponsorships
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
            [['rankName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rankName' => 'Rank Name',
        ];
    }

    /**
     * Gets query for [[Rankshistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRankshistories()
    {
        return $this->hasMany(Rankshistory::className(), ['rankId' => 'id']);
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
}
