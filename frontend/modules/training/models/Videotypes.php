<?php

namespace frontend\modules\training\models;

use Yii;

/**
 * This is the model class for table "videotypes".
 *
 * @property int $id
 * @property string $typeName
 * @property string $urlPrefix
 *
 * @property Videolist[] $videolists
 */
class Videotypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videotypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['typeName', 'urlPrefix'], 'required'],
            [['typeName', 'urlPrefix'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'typeName' => Yii::t('app', 'Type Name'),
            'urlPrefix' => Yii::t('app', 'Url Prefix'),
        ];
    }

    /**
     * Gets query for [[Videolists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVideolists()
    {
        return $this->hasMany(Videolist::className(), ['videoType' => 'id']);
    }
}
