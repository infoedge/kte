<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "pointtrxtypes".
 *
 * @property int $id
 * @property string $trxTypeName
 *
 * @property Scorecard[] $scorecards
 */
class Pointtrxtypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pointtrxtypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['trxTypeName'], 'required'],
            [['trxTypeName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trxTypeName' => Yii::t('app', 'Transaction Type Name'),
        ];
    }

    /**
     * Gets query for [[Scorecards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getScorecards()
    {
        return $this->hasMany(Scorecard::className(), ['transactionType' => 'id']);
    }
}
