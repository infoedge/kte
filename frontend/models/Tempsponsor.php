<?php

namespace app\models;

use Yii;
use common\models\User;
use frontend\modules\basic\models\People;

/**
 * This is the model class for table "tempsponsor".
 *
 * @property int $id
 * @property int $member
 * @property int $sponsor Used when a user self registers.
 * @property int $RecordBy
 * @property string $RecordDate
 *
 * @property User $member0
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
            [['member', 'sponsor', 'RecordBy', 'RecordDate'], 'required'],
            [['member', 'sponsor', 'RecordBy'], 'integer'],
            [['RecordDate'], 'safe'],
            [['member'], 'unique'],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['member' => 'id']],
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
            'id' => 'ID',
            'member' => 'Member',
            'sponsor' => 'Sponsor',
            'RecordBy' => 'Record By',
            'RecordDate' => 'Record Date',
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
