<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "withdrawaltypes".
 *
 * @property int $id
 * @property string $typeName
 *
 * @property Tblwithdrawal[] $tblwithdrawals
 */
class Withdrawaltypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'withdrawaltypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['typeName'], 'required'],
            [['typeName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'typeName' => Yii::t('app', 'Withdraw To'),
        ];
    }

    /**
     * Gets query for [[Tblwithdrawals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblwithdrawals()
    {
        return $this->hasMany(Tblwithdrawal::className(), ['withdrawalType' => 'id']);
    }
}
