<?php

namespace backend\modules\messaging\models;

use Yii;

/**
 * This is the model class for table "tblmsgtypes".
 *
 * @property int $id
 * @property string $typeName
 */
class Tblmsgtypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblmsgtypes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['typeName'], 'required'],
            [['typeName'], 'string', 'max' => 45],
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
        ];
    }
}
