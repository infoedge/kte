<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "bonustypes".
 *
 * @property int $id
 * @property string $bonusTypeName
 *
 * @property Tblpoints[] $tblpoints
 */
class Bonustypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bonustypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bonusTypeName'], 'required'],
            [['bonusTypeName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'bonusTypeName' => Yii::t('app', 'Bonus Type Name'),
        ];
    }

    /**
     * Gets query for [[Tblpoints]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblpoints()
    {
        return $this->hasMany(Tblpoints::className(), ['bonusType' => 'id']);
    }
}
