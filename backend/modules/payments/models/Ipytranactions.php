<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "ipytranactions".
 *
 * @property int $id
 * @property int $custId
 * @property string $orderId
 * @property string|null $invoiceId
 * @property int $payChannel
 * @property float $amount
 * @property int $direction
 * @property string $currency
 * @property int|null $emailNotify
 *
 * @property People $cust
 * @property Ipychannels $payChannel0
 */
class Ipytranactions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ipytranactions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'custId', 'orderId', 'payChannel', 'currency'], 'required'],
            [['id', 'custId', 'payChannel', 'direction', 'emailNotify'], 'integer'],
            [['amount'], 'number'],
            [['orderId', 'invoiceId', 'currency'], 'string', 'max' => 45],
            [['id'], 'unique'],
            [['custId'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['custId' => 'id']],
            [['payChannel'], 'exist', 'skipOnError' => true, 'targetClass' => Ipychannels::className(), 'targetAttribute' => ['payChannel' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'custId' => Yii::t('app', 'Cust ID'),
            'orderId' => Yii::t('app', 'Order ID'),
            'invoiceId' => Yii::t('app', 'Invoice ID'),
            'payChannel' => Yii::t('app', 'Pay Channel'),
            'amount' => Yii::t('app', 'Amount'),
            'direction' => Yii::t('app', 'Direction'),
            'currency' => Yii::t('app', 'Currency'),
            'emailNotify' => Yii::t('app', 'Email Notify'),
        ];
    }

    /**
     * Gets query for [[Cust]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCust()
    {
        return $this->hasOne(People::className(), ['id' => 'custId']);
    }

    /**
     * Gets query for [[PayChannel0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayChannel0()
    {
        return $this->hasOne(Ipychannels::className(), ['id' => 'payChannel']);
    }
}
