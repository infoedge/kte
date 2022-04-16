<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "referralbonusconfig".
 *
 * @property int $id
 * @property int $trxType format => xxyyzzaabb; xx=trxType; yy=sPackage; zz=sRank; aa=mPackage; bb= level
 * @property int $sPackage Sponsor Package
 * @property int $sRank Sponsor Rank
 * @property int $mPackage Member Package
 * @property int $level
 * @property float $amount
 * @property int $recordBy
 * @property string $recordDate
 * @property int|null $changedBy
 * @property int|null $changedDate
 * @property string $configCntrl
 *
 * @property Packages $mPackage0
 * @property Packages $sPackage0
 * @property Ranks $sRank0
 * @property Paymenttypes $trxType0
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
            [['trxType', 'sPackage', 'sRank', 'mPackage', 'level', 'amount', 'recordBy', 'recordDate', 'configCntrl'], 'required'],
            [['trxType', 'sPackage', 'sRank', 'mPackage', 'level', 'recordBy', 'changedBy', 'changedDate'], 'integer'],
            [['amount'], 'number'],
            [['recordDate'], 'safe'],
            [['configCntrl'], 'string', 'max' => 20],
            [['configCntrl'], 'unique'],
            [['mPackage'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['mPackage' => 'id']],
            [['sPackage'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['sPackage' => 'id']],
            [['sRank'], 'exist', 'skipOnError' => true, 'targetClass' => Ranks::className(), 'targetAttribute' => ['sRank' => 'id']],
            [['trxType'], 'exist', 'skipOnError' => true, 'targetClass' => Paymenttypes::className(), 'targetAttribute' => ['trxType' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'trxType' => Yii::t('app', 'Trx Type'),
            'sPackage' => Yii::t('app', 'S Package'),
            'sRank' => Yii::t('app', 'S Rank'),
            'mPackage' => Yii::t('app', 'M Package'),
            'level' => Yii::t('app', 'Level'),
            'amount' => Yii::t('app', 'Amount'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'changedBy' => Yii::t('app', 'Changed By'),
            'changedDate' => Yii::t('app', 'Changed Date'),
            'configCntrl' => Yii::t('app', 'Config Cntrl'),
        ];
    }

    /**
     * Gets query for [[MPackage0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMPackage0()
    {
        return $this->hasOne(Packages::className(), ['id' => 'mPackage']);
    }

    /**
     * Gets query for [[SPackage0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSPackage0()
    {
        return $this->hasOne(Packages::className(), ['id' => 'sPackage']);
    }

    /**
     * Gets query for [[SRank0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSRank0()
    {
        return $this->hasOne(Ranks::className(), ['id' => 'sRank']);
    }

    /**
     * Gets query for [[TrxType0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrxType0()
    {
        return $this->hasOne(Paymenttypes::className(), ['id' => 'trxType']);
    }
}
