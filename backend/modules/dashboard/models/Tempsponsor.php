<?php

namespace backend\modules\dashboard\models;

use Yii;

/**
 * This is the model class for table "tempsponsor".
 *
 * @property int $id
 * @property int $child
 * @property int $sponsor Used when a user self registers.
 * @property int $RecordBy
 * @property string $RecordDate
 *
 * @property User $child0
 * @property User $recordBy
 * @property People $sponsor0
 */
class Tempsponsor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tempsponsor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['child', 'sponsor', 'RecordBy', 'RecordDate'], 'required'],
            [['child', 'sponsor', 'RecordBy'], 'integer'],
            [['RecordDate'], 'safe'],
            [['child'], 'unique'],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['child' => 'id']],
            [['RecordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['RecordBy' => 'id']],
            [['sponsor'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['sponsor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'child' => Yii::t('app', 'Child'),
            'sponsor' => Yii::t('app', 'Sponsor'),
            'RecordBy' => Yii::t('app', 'Record By'),
            'RecordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * Gets query for [[Child0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(User::className(), ['id' => 'child']);
    }

    /**
     * Gets query for [[RecordBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecordBy()
    {
        return $this->hasOne(User::className(), ['id' => 'RecordBy']);
    }

    /**
     * Gets query for [[Sponsor0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsor0()
    {
        return $this->hasOne(People::className(), ['id' => 'sponsor']);
    }
}
