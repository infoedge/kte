<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "compensationunits".
 *
 * @property int $id
 * @property string $UnitName
 * @property string $unitShortform
 *
 * @property Packconfig[] $packconfigs
 */
class Compensationunits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'compensationunits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UnitName', 'unitShortform'], 'required'],
            [['UnitName'], 'string', 'max' => 45],
            [['unitShortform'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'UnitName' => Yii::t('app', 'Unit Name'),
            'unitShortform' => Yii::t('app', 'Unit Shortform'),
        ];
    }

    /**
     * Gets query for [[Packconfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackconfigs()
    {
        return $this->hasMany(Packconfig::className(), ['units' => 'id']);
    }
}
