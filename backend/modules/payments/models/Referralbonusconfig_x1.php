<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "referralbonusconfig".
 *
 * @property int $id
 * @property int $package
 * @property int $rank
 * @property float $level
 * @property float $amount
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property Packages $package0
 * @property Ranks $rank0
 */
class Referralbonusconfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'referralbonusconfig';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['package', 'rank', 'level', 'amount', 'recordBy', 'recordDate'], 'required'],
            [['package', 'rank', 'recordBy'], 'integer'],
            [['level', 'amount'], 'number'],
            [['recordDate'], 'safe'],
            [['package'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['package' => 'id']],
            [['rank'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['rank' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'package' => Yii::t('app', 'Package'),
            'rank' => Yii::t('app', 'Rank'),
            'level' => Yii::t('app', 'Level'),
            'amount' => Yii::t('app', 'Amount to Sponsor($)'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * Gets query for [[Package0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackage0()
    {
        return $this->hasOne(Packages::className(), ['id' => 'package']);
    }

    /**
     * Gets query for [[Rank0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRank0()
    {
        return $this->hasOne(Ranks::className(), ['id' => 'rank']);
    }
}
