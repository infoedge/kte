<?php

namespace frontend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "c_flags".
 *
 * @property int $id
 * @property int $c_id
 * @property string $country
 * @property string $countryFlag
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
            [['country', 'countryFlag'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'c_id' => Yii::t('app', 'C ID'),
            'country' => Yii::t('app', 'Country'),
            'countryFlag' => Yii::t('app', 'Country Flag'),
        ];
    }
}
