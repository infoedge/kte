<?php

namespace backend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "identitytypes".
 *
 * @property int $id
 * @property string $idTypeName
 *
 * @property People[] $peoples
 */
class Identitytypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'identitytypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idTypeName'], 'required'],
            [['idTypeName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idTypeName' => Yii::t('app', 'Id Type Name'),
        ];
    }

    /**
     * Gets query for [[Peoples]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeoples()
    {
        return $this->hasMany(People::className(), ['IdentityType' => 'id']);
    }
}
