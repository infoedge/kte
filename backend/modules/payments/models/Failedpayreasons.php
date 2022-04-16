<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "failedpayreasons".
 *
 * @property int $id
 * @property int $inpaymentId
 * @property int $rejectedBy
 * @property int $rejectedDate
 * @property string $rejectedReason
 *
 * @property Inpayments $inpayment
 */
class Failedpayreasons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'failedpayreasons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['inpaymentId', 'rejectedBy', 'rejectedDate', 'rejectedReason'], 'required'],
            [['inpaymentId', 'rejectedBy', 'rejectedDate'], 'integer'],
            [['rejectedReason'], 'string', 'max' => 255],
            [['inpaymentId'], 'exist', 'skipOnError' => true, 'targetClass' => Inpayments::className(), 'targetAttribute' => ['inpaymentId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'inpaymentId' => Yii::t('app', 'Inpayment ID'),
            'rejectedBy' => Yii::t('app', 'Rejected By'),
            'rejectedDate' => Yii::t('app', 'Rejected Date'),
            'rejectedReason' => Yii::t('app', 'Rejected Reason'),
        ];
    }

    /**
     * Gets query for [[Inpayment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInpayment()
    {
        return $this->hasOne(Inpayments::className(), ['id' => 'inpaymentId']);
    }
}
