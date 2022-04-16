<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property string $packName
 * @property float $dailyCyclesCapping
 *
 * @property Inpayments[] $inpayments
 * @property Membershiphistory[] $membershiphistories
 * @property Packconfig[] $packconfigs
 * @property Referralbonusconfig[] $referralbonusconfigs
 * @property Referralbonusconfig[] $referralbonusconfigs0
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['packName'], 'required'],
            [['dailyCyclesCapping'], 'number'],
            [['packName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'packName' => Yii::t('app', 'Pack Name'),
            'dailyCyclesCapping' => Yii::t('app', 'Daily Cycles Capping($)'),
        ];
    }

    /**
     * Gets query for [[Inpayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInpayments()
    {
        return $this->hasMany(Inpayments::className(), ['package' => 'id']);
    }

    /**
     * Gets query for [[Membershiphistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMembershiphistories()
    {
        return $this->hasMany(Membershiphistory::className(), ['packageId' => 'id']);
    }

    /**
     * Gets query for [[Packconfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackconfigs()
    {
        return $this->hasMany(Packconfig::className(), ['packId' => 'id']);
    }

    /**
     * Gets query for [[Referralbonusconfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReferralbonusconfigs()
    {
        return $this->hasMany(Referralbonusconfig::className(), ['mPackage' => 'id']);
    }

    /**
     * Gets query for [[Referralbonusconfigs0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReferralbonusconfigs0()
    {
        return $this->hasMany(Referralbonusconfig::className(), ['sPackage' => 'id']);
    }
}
