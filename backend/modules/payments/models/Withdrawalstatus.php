<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "withdrawalstatus".
 *
 * @property int $id
 * @property string $statusName
 */
class Withdrawalstatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'withdrawalstatus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['statusName'], 'required'],
            [['statusName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'statusName' => Yii::t('app', 'Status Name'),
        ];
    }
}
