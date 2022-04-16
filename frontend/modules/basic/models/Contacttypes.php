<?php

namespace frontend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "contacttypes".
 *
 * @property integer $id
 * @property string $contacttypeName
 * @property integer $recordBy
 * @property string $recordDate
 *
 * @property Contacts[] $contacts
 */
class Contacttypes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacttypes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contacttypeName'], 'required'],
            [['recordBy'], 'integer'],
            [['recordDate'], 'safe'],
            [['contacttypeName'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'contacttypeName' => Yii::t('app', 'Contact Type'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['ContactType' => 'id']);
    }
}
