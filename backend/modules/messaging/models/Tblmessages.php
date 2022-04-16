<?php

namespace backend\modules\messaging\models;

use Yii;

/**
 * This is the model class for table "tblmessages".
 *
 * @property int $id
 * @property int $msgId
 * @property int $sentBy
 * @property int $sentTo
 * @property string $dateSent
 * @property string|null $confirmMsgSentDate
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property Tblmsgtexts $msg
 * @property People $sentTo0
 * @property People $sentTo1
 */
class Tblmessages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblmessages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['msgId', 'sentBy', 'sentTo', 'dateSent', 'recordBy', 'recordDate'], 'required'],
            [['msgId', 'sentBy', 'sentTo', 'recordBy'], 'integer'],
            [['dateSent', 'confirmMsgSentDate', 'recordDate'], 'safe'],
            [['msgId'], 'exist', 'skipOnError' => true, 'targetClass' => Tblmsgtexts::className(), 'targetAttribute' => ['msgId' => 'id']],
            [['sentTo'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['sentTo' => 'id']],
            [['sentTo'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['sentTo' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'msgId' => Yii::t('app', 'Msg ID'),
            'sentBy' => Yii::t('app', 'Sent By'),
            'sentTo' => Yii::t('app', 'Sent To'),
            'dateSent' => Yii::t('app', 'Date Sent'),
            'confirmMsgSentDate' => Yii::t('app', 'Confirm Msg Sent Date'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * Gets query for [[Msg]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMsg()
    {
        return $this->hasOne(Tblmsgtexts::className(), ['id' => 'msgId']);
    }

    /**
     * Gets query for [[SentTo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSentTo0()
    {
        return $this->hasOne(People::className(), ['id' => 'sentTo']);
    }

    /**
     * Gets query for [[SentTo1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSentTo1()
    {
        return $this->hasOne(People::className(), ['id' => 'sentTo']);
    }
}
