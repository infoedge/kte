<?php

namespace frontend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "contacts".
 *
 * @property integer $id
 * @property integer $PersonId
 * @property integer $ContactType
 * @property string $ContactsValue
 * @property integer $recordBy
 * @property string $recordDate
 * @property integer $changedBy
 * @property string $changedDate
 *
 * @property Contacttypes $contactType
 * @property People $person
 */
class Contacts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PersonId', 'ContactType', 'ContactsValue', 'recordBy', 'recordDate'], 'required'],
            [['PersonId', 'ContactType', 'recordBy', 'changedBy'], 'integer'],
            [['recordDate', 'changedDate'], 'safe'],
            [['ContactsValue'], 'string', 'max' => 45],
            [['ContactType'], 'exist', 'skipOnError' => true, 'targetClass' => Contacttypes::className(), 'targetAttribute' => ['ContactType' => 'id']],
            [['PersonId'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['PersonId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'PersonId' => Yii::t('app', 'Person\'s Name'),
            'ContactType' => Yii::t('app', 'Contact Type'),
            'ContactsValue' => Yii::t('app', 'Contact Value'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'changedBy' => Yii::t('app', 'Changed By'),
            'changedDate' => Yii::t('app', 'Changed Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactType()
    {
        return $this->hasOne(Contacttypes::className(), ['id' => 'ContactType']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(People::className(), ['id' => 'PersonId']);
    }
}
