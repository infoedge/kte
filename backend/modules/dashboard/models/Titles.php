<?php

namespace backend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "titles".
 *
 * @property int $id
 * @property string $title
 *
 * @property People[] $peoples
 */
class Titles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'titles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
        ];
    }

    /**
     * Gets query for [[Peoples]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeoples()
    {
        return $this->hasMany(People::className(), ['titleId' => 'id']);
    }
}
