<?php

namespace frontend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property int $id
 * @property string $packName
 *
 * @property Packconfig[] $packconfigs
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['packName'], 'required'],
            [['packName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'packName' => Yii::t('app', 'Package Name'),
        ];
    }

    /**
     * Gets query for [[Packconfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPackconfigs()
    {
        return $this->hasMany(Packconfig::className(), ['packId' => 'id']);
    }
}
