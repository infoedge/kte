<?php

namespace frontend\modules\training\models;

use Yii;

/**
 * This is the model class for table "videotopics".
 *
 * @property int $id
 * @property string $topicName
 *
 * @property Videolist[] $videolists
 */
class Videotopics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videotopics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['topicName'], 'required'],
            [['topicName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'topicName' => Yii::t('app', 'Topic Name'),
        ];
    }

    /**
     * Gets query for [[Videolists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVideolists()
    {
        return $this->hasMany(Videolist::className(), ['vTopic' => 'id']);
    }
}
