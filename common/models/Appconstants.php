<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "appconstants".
 *
 * @property int $id
 * @property string $constantName
 * @property float $constantValue
 * @property int $constantUnits
 * @property string|null $fromDate
 * @property string|null $toDate
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property Constantunits $constantUnits0
 */
class Appconstants extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appconstants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['constantName', 'constantValue', 'constantUnits'], 'required'],
            [['constantValue'], 'number'],
            [['constantUnits', 'recordBy'], 'integer'],
            [['fromDate', 'toDate', 'recordDate'], 'safe'],
            [['constantName'], 'string', 'max' => 45],
            [['constantUnits'], 'exist', 'skipOnError' => true, 'targetClass' => Constantunits::className(), 'targetAttribute' => ['constantUnits' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'constantName' => Yii::t('app', 'Constant Name'),
            'constantValue' => Yii::t('app', 'Constant Value'),
            'constantUnits' => Yii::t('app', 'Constant Units'),
            'fromDate' => Yii::t('app', 'From Date'),
            'toDate' => Yii::t('app', 'To Date'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * Gets query for [[ConstantUnits0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConstantUnits0()
    {
        return $this->hasOne(Constantunits::className(), ['id' => 'constantUnits']);
    }
}
