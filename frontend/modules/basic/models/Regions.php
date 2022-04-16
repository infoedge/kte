<?php

namespace frontend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "regions".
 *
 * @property int $id
 * @property string $RegionName
 * @property int $CountryId
 *
 * @property Locations[] $locations
 * @property Countries $country
 */
class Regions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'regions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['RegionName', 'CountryId'], 'required'],
            [['CountryId'], 'integer'],
            [['RegionName'], 'string', 'max' => 45],
            [['CountryId'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['CountryId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'RegionName' => Yii::t('app', 'Region Name'),
            'CountryId' => Yii::t('app', 'Country'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Locations::className(), ['RegionId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'CountryId']);
    }
}
