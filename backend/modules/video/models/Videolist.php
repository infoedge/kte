<?php

namespace backend\modules\video\models;

use Yii;

/**
 * This is the model class for table "videolist".
 *
 * @property int $id
 * @property int $vTopic
 * @property int $videoType
 * @property string $vid
 * @property string|null $vDesc
 * @property string $vName
 * @property int $order
 * @property string $fromDate
 * @property string|null $toDate
 *
 * @property Videotopics $vTopic0
 * @property Videotypes $videoType0
 */
class Videolist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videolist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vTopic', 'vid', 'vName', 'order', 'fromDate'], 'required'],
            [['vTopic', 'videoType', 'order'], 'integer'],
            [['fromDate', 'toDate'], 'safe'],
            [['vid'], 'string', 'max' => 75],
            [['vDesc'], 'string', 'max' => 255],
            [['vName'], 'string', 'max' => 150],
            [['vid'], 'unique'],
            [['vTopic'], 'exist', 'skipOnError' => true, 'targetClass' => Videotopics::className(), 'targetAttribute' => ['vTopic' => 'id']],
            [['videoType'], 'exist', 'skipOnError' => true, 'targetClass' => Videotypes::className(), 'targetAttribute' => ['videoType' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'vTopic' => Yii::t('app', 'Video Topic'),
            'videoType' => Yii::t('app', 'Video Type'),
            'vid' => Yii::t('app', 'Video ID'),
            'vDesc' => Yii::t('app', 'Video Description'),
            'vName' => Yii::t('app', 'Video Name'),
            'order' => Yii::t('app', 'Order'),
            'fromDate' => Yii::t('app', 'From Date'),
            'toDate' => Yii::t('app', 'To Date'),
        ];
    }

    /**
     * Gets query for [[VTopic0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVTopic0()
    {
        return $this->hasOne(Videotopics::className(), ['id' => 'vTopic']);
    }

    /**
     * Gets query for [[VideoType0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVideoType0()
    {
        return $this->hasOne(Videotypes::className(), ['id' => 'videoType']);
    }
    
}
