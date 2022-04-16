<?php

namespace backend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "c_flags".
 *
 * @property int $id
 * @property int $c_id
 * @property string $country
 * @property string $countryFlag
 *
 * @property Countries $c
 */
class CFlags extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'c_flags';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_id', 'country', 'countryFlag'], 'required'],
            [['c_id'], 'integer'],
            [['country'], 'string', 'max' => 30],
            [['countryFlag'], 'string', 'max' => 50],
            [['c_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['c_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'c_id' => Yii::t('app', 'Country Name'),
            'country' => Yii::t('app', 'Country'),
            'countryFlag' => Yii::t('app', 'Country Flag'),
        ];
    }

    /**
     * Gets query for [[C]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getC()
    {
        return $this->hasOne(Countries::className(), ['id' => 'c_id']);
    }
}
