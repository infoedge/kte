<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "tbl_exchange_rates".
 *
 * @property int $id
 * @property int $currency
 * @property float $rate
 * @property string $fromDate
 * @property string|null $toDate
 *
 * @property TblCurrencies $currency0
 */
class TblExchangeRates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_exchange_rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currency', 'rate', 'fromDate'], 'required'],
            [['currency'], 'integer'],
            [['rate'], 'number'],
            [['fromDate', 'toDate'], 'safe'],
            [['currency'], 'exist', 'skipOnError' => true, 'targetClass' => TblCurrencies::className(), 'targetAttribute' => ['currency' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'currency' => Yii::t('app', 'Currency'),
            'rate' => Yii::t('app', 'Rate'),
            'fromDate' => Yii::t('app', 'From Date'),
            'toDate' => Yii::t('app', 'To Date'),
        ];
    }

    /**
     * Gets query for [[Currency0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency0()
    {
        return $this->hasOne(TblCurrencies::className(), ['id' => 'currency']);
    }
}
