<?php

namespace frontend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "packconfig".
 *
 * @property int $id
 * @property int $packId
 * @property int $trxType
 * @property float $amount
 * @property float $sponsorPoints
 * @property float $cyclePoints
 * @property int $recordBy
 * @property string $recordDate
 * @property int|null $changedBy
 * @property string|null $changeDate
 *
 * @property Packages $pack
 * @property Pointtrxtypes $trxType0
 */
class Packconfig extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packconfig';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['packId', 'trxType', 'amount', 'recordBy', 'recordDate'], 'required'],
            [['packId', 'trxType', 'recordBy', 'changedBy'], 'integer'],
            [['amount', 'sponsorPoints', 'cyclePoints'], 'number'],
            [['recordDate', 'changeDate'], 'safe'],
            [['packId'], 'exist', 'skipOnError' => true, 'targetClass' => Packages::className(), 'targetAttribute' => ['packId' => 'id']],
            [['trxType'], 'exist', 'skipOnError' => true, 'targetClass' => Pointtrxtypes::className(), 'targetAttribute' => ['trxType' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'packId' => Yii::t('app', 'Pack ID'),
            'trxType' => Yii::t('app', 'Trx Type'),
            'amount' => Yii::t('app', 'Amount'),
            'sponsorPoints' => Yii::t('app', 'Sponsor Points'),
            'cyclePoints' => Yii::t('app', 'Cycle Points'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'changedBy' => Yii::t('app', 'Changed By'),
            'changeDate' => Yii::t('app', 'Change Date'),
        ];
    }

    /**
     * Gets query for [[Pack]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPack()
    {
        return $this->hasOne(Packages::className(), ['id' => 'packId']);
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
    public function getTypeAndPack()
    {
        return $this->getTrxType0();
    }
    
}
