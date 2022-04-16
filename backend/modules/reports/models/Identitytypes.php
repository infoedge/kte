<?php

namespace backend\modules\reports\models;

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
            'id' => 'ID',
            'idTypeName' => 'Id Type Name',
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
