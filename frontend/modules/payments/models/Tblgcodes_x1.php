<?php

namespace frontend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "tblgcodes".
 *
 * @property int $id
 * @property string $code
 * @property int $memberGen
 * @property string $dateGen
 * @property float $amount
 * @property string|null $retrivedate
 * @property int|null $retrieveBy
 * @property int $recordBy
 * @property string $recordDate
 * @property int|null $changedBy
 * @property string|null $changedDate
 *
 * @property People $retrieveBy0
 * @property User $changedBy0
 * @property People $memberGen0
 * @property User $recordBy0
 */
class Tblgcodes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblgcodes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['code', 'memberGen', 'dateGen', 'amount', 'recordBy', 'recordDate'], 'required'],
            [['memberGen', 'retrieveBy', 'recordBy', 'changedBy'], 'integer'],
            [['dateGen', 'retrivedate', 'recordDate', 'changedDate'], 'safe'],
            [['amount'], 'number'],
            [['code'], 'string', 'max' => 10],
            [['code'], 'unique'],
            [['retrieveBy'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['retrieveBy' => 'id']],
            [['changedBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['changedBy' => 'id']],
            [['memberGen'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['memberGen' => 'id']],
            [['recordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recordBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'memberGen' => Yii::t('app', 'Member Gen'),
            'dateGen' => Yii::t('app', 'Date Gen'),
            'amount' => Yii::t('app', 'Gift Code Type'),
            'retrivedate' => Yii::t('app', 'Retrivedate'),
            'retrieveBy' => Yii::t('app', 'Send To'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
            'changedBy' => Yii::t('app', 'Changed By'),
            'changedDate' => Yii::t('app', 'Changed Date'),
        ];
    }

    /**
     * Gets query for [[RetrieveBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRetrieveBy0()
    {
        return $this->hasOne(People::className(), ['id' => 'retrieveBy']);
    }

    /**
     * Gets query for [[ChangedBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChangedBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'changedBy']);
    }

    /**
     * Gets query for [[MemberGen0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberGen0()
    {
        return $this->hasOne(People::className(), ['id' => 'memberGen']);
    }

    /**
     * Gets query for [[RecordBy0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecordBy0()
    {
        return $this->hasOne(User::className(), ['id' => 'recordBy']);
    }
}
