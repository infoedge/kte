<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "compensationtypes".
 *
 * @property int $id
 * @property string $compTypeName
 *
 * @property Packconfig[] $packconfigs
 */
class Compensationtypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compensationtypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['compTypeName'], 'required'],
            [['compTypeName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'compTypeName' => Yii::t('app', 'Compensation Type Name'),
        ];
    }

    /**
     * Gets query for [[Packconfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackconfigs()
    {
        return $this->hasMany(Packconfig::className(), ['cmpsntype' => 'id']);
    }
}
