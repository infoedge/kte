<?php

namespace backend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "statuses".
 *
 * @property int $id
 * @property string $Status
 *
 * @property Membershiphistory[] $membershiphistories
 * @property Sponsorship[] $sponsorships
 */
class Statuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Status'], 'required'],
            [['Status'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Membershiphistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershiphistories()
    {
        return $this->hasMany(Membershiphistory::className(), ['status' => 'id']);
    }

    /**
     * Gets query for [[Sponsorships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorships()
    {
        return $this->hasMany(Sponsorship::className(), ['status' => 'id']);
    }
}
