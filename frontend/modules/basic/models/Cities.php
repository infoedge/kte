<?php

namespace frontend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $city
 * @property int $country
 * @property string|null $area
 * @property int|null $geonameid
 *
 * @property Countries $country0
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['city', 'country'], 'required'],
            [['country', 'geonameid'], 'integer'],
            [['city', 'area'], 'string', 'max' => 45],
            [['country'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city' => Yii::t('app', 'City'),
            'country' => Yii::t('app', 'Country'),
            'area' => Yii::t('app', 'Area'),
            'geonameid' => Yii::t('app', 'Geonameid'),
        ];
    }

    /**
     * Gets query for [[Country0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry0()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country']);
    }
}
