<?php

namespace frontend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "dialcodes".
 *
 * @property int $id
 * @property int $c_id
 * @property int $countryCode
 * @property string $exitCode
 * @property string $trunkCode
 */
class Dialcodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dialcodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['c_id', 'countryCode', 'exitCode', 'trunkCode'], 'required'],
            [['c_id', 'countryCode'], 'integer'],
            [['exitCode', 'trunkCode'], 'string', 'max' => 30],
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
            'countryCode' => Yii::t('app', 'Country Code'),
            'exitCode' => Yii::t('app', 'Exit Code'),
            'trunkCode' => Yii::t('app', 'Trunk Code'),
        ];
    }
}
