<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property string $packName
 *
 * @property Inpayments[] $inpayments
 * @property Membershiphistory[] $membershiphistories
 * @property Packconfig[] $packconfigs
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
            [[ 'packName'], 'required'],
            [['id'], 'integer'],
            [['packName'], 'string', 'max' => 45],
            [['id'], 'unique'],
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
}
