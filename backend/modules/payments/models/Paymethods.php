<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "paymethods".
 *
 * @property int $id
 * @property string $methodName
 *
 * @property Commissions[] $commissions
 * @property Inpayments[] $inpayments
 * @property Wallet[] $wallets
 */
class Paymethods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paymethods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['methodName'], 'required'],
            [['methodName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'methodName' => 'Method Name',
        ];
    }

    /**
     * Gets query for [[Commissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommissions()
    {
        return $this->hasMany(Commissions::className(), ['trxMethod' => 'id']);
    }

    /**
     * Gets query for [[Inpayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInpayments()
    {
        return $this->hasMany(Inpayments::className(), ['pMethod' => 'id']);
    }

    /**
     * Gets query for [[Wallets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWallets()
    {
        return $this->hasMany(Wallet::className(), ['trxMethod' => 'id']);
    }
}
