<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "ipychannels".
 *
 * @property int $id
 * @property string $channelName
 *
 * @property Ipytranactions[] $ipytranactions
 */
class Ipychannels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ipychannels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['channelName'], 'required'],
            [['channelName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'channelName' => Yii::t('app', 'Channel Name'),
        ];
    }

    /**
     * Gets query for [[Ipytranactions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIpytranactions()
    {
        return $this->hasMany(Ipytranactions::className(), ['payChannel' => 'id']);
    }
}
