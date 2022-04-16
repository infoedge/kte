<?php

namespace backend\modules\messaging\models;

use Yii;

/**
 * This is the model class for table "tblmsgtexts".
 *
 * @property int $id
 * @property int $msgType
 * @property string $subject
 * @property string $msgText
 *
 * @property Tblmessages[] $tblmessages
 */
class Tblmsgtexts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblmsgtexts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['msgType', 'subject', 'msgText'], 'required'],
            [['msgType'], 'integer'],
            [['msgText'], 'string'],
            [['subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'msgType' => Yii::t('app', 'Message Type'),
            'subject' => Yii::t('app', 'Subject'),
            'msgText' => Yii::t('app', 'Message Text'),
        ];
    }

    /**
     * Gets query for [[Tblmessages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblmessages()
    {
        return $this->hasMany(Tblmessages::className(), ['msgId' => 'id']);
    }
}
