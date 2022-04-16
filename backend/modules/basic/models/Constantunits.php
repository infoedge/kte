<?php

namespace backend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "constantunits".
 *
 * @property int $id
 * @property string $unitName
 *
 * @property Appconstants[] $appconstants
 */
class Constantunits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'constantunits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['unitName'], 'required'],
            [['unitName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'unitName' => Yii::t('app', 'Unit Name'),
        ];
    }

    /**
     * Gets query for [[Appconstants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAppconstants()
    {
        return $this->hasMany(Appconstants::className(), ['constantUnits' => 'id']);
    }
}
