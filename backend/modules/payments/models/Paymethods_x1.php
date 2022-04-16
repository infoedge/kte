<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "paymethods".
 *
 * @property int $id
 * @property string $methodName
 */
class Paymethods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'paymethods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['methodName'], 'required'],
            [['methodName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'methodName' => Yii::t('app', 'Method Name'),
        ];
    }
}
