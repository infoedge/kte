<?php

namespace backend\modules\reports\models;

use Yii;

/**
 * This is the model class for table "paymenttypes".
 *
 * @property int $id
 * @property string $ptypeName
 *
 * @property Inpayments[] $inpayments
 * @property Packconfig[] $packconfigs
 * @property Referralbonusconfig[] $referralbonusconfigs
 */
class Paymenttypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paymenttypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ptypeName'], 'required'],
            [['ptypeName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ptypeName' => 'Ptype Name',
        ];
    }

    /**
     * Gets query for [[Inpayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInpayments()
    {
        return $this->hasMany(Inpayments::className(), ['ptype' => 'id']);
    }

    /**
     * Gets query for [[Packconfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackconfigs()
    {
        return $this->hasMany(Packconfig::className(), ['trxType' => 'id']);
    }

    /**
     * Gets query for [[Referralbonusconfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReferralbonusconfigs()
    {
        return $this->hasMany(Referralbonusconfig::className(), ['trxType' => 'id']);
    }
}
