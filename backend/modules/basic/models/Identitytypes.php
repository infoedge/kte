<?php

namespace backend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "identitytypes".
 *
 * @property integer $id
 * @property string $idTypeName
 */
class Identitytypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'identitytypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTypeName'], 'required'],
            [['idTypeName'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idTypeName' => Yii::t('app', 'Identity Type'),
        ];
    }
}
