<?php

namespace frontend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property int $id
 * @property string $Name
 * @property string|null $Symbol
 *
 * @property Cities[] $cities
 * @property People[] $peoples
 * @property Regions[] $regions
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Name'], 'required'],
            [['Name', 'Symbol'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'Name' => Yii::t('app', 'Name'),
            'Symbol' => Yii::t('app', 'Symbol'),
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['country' => 'id']);
    }

    /**
     * Gets query for [[Peoples]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeoples()
    {
        return $this->hasMany(People::className(), ['nationality' => 'id']);
    }

    /**
     * Gets query for [[Regions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegions()
    {
        return $this->hasMany(Regions::className(), ['CountryId' => 'id']);
    }
}
