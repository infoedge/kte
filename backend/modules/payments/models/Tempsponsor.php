<?php

namespace backend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "tempsponsor".
 *
 * @property int $id
 * @property int $member
 * @property int $sponsor
 * @property int $parent
 * @property int $lft
 * @property int $RecordBy
 * @property string $RecordDate
 *
 * @property User $member0
 * @property User $recordBy
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
            [['member', 'sponsor', 'parent', 'lft', 'RecordBy', 'RecordDate'], 'required'],
            [['member', 'sponsor', 'parent', 'lft', 'RecordBy'], 'integer'],
            [['RecordDate'], 'safe'],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['member' => 'id']],
            [['RecordBy'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['RecordBy' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member' => Yii::t('app', 'Member'),
            'sponsor' => Yii::t('app', 'Sponsor'),
            'parent' => Yii::t('app', 'Parent'),
            'lft' => Yii::t('app', 'Lft'),
            'RecordBy' => Yii::t('app', 'Record By'),
            'RecordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * Gets query for [[Member0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember0()
    {
        return $this->hasOne(User::className(), ['id' => 'member']);
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
}
