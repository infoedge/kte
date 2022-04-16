<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "tbl_currencies".
 *
 * @property int $id
 * @property string $currencyName
 * @property string $ShortName
 * @property string $Symbol
 *
 * @property TblExchangeRates[] $tblExchangeRates
 */
class TblCurrencies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_currencies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['currencyName', 'ShortName', 'Symbol'], 'required'],
            [['currencyName'], 'string', 'max' => 45],
            [['ShortName', 'Symbol'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'currencyName' => Yii::t('app', 'Currency Name'),
            'ShortName' => Yii::t('app', 'Short Name'),
            'Symbol' => Yii::t('app', 'Symbol'),
        ];
    }

    /**
     * Gets query for [[TblExchangeRates]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblExchangeRates()
    {
        return $this->hasMany(TblExchangeRates::className(), ['currency' => 'id']);
    }
}
