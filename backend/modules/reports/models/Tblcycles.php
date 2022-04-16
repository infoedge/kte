<?php

namespace backend\modules\reports\models;

use Yii;

/**
 * This is the model class for table "tblcycles".
 *
 * @property int $id
 * @property int $member
 * @property int $memberFrom
 * @property float|null $lft
 * @property float|null $rgt
 * @property string $earnDate
 * @property int $cyclesValid 1=valid; -1=invalid
 * @property string|null $comment
 * @property string|null $trxDate
 * @property int|null $trxBy
 *
 * @property People $member0
 * @property People $memberFrom0
 */
class Tblcycles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblcycles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['member', 'memberFrom', 'earnDate'], 'required'],
            [['member', 'memberFrom', 'cyclesValid', 'trxBy'], 'integer'],
            [['lft', 'rgt'], 'number'],
            [['earnDate', 'trxDate'], 'safe'],
            [['comment'], 'string', 'max' => 45],
            [['member'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['member' => 'id']],
            [['memberFrom'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['memberFrom' => 'id']],
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
            'memberFrom' => 'Member From',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'earnDate' => 'Earn Date',
            'cyclesValid' => 'Cycles Valid',
            'comment' => 'Comment',
            'trxDate' => 'Trx Date',
            'trxBy' => 'Trx By',
        ];
    }

    /**
     * Gets query for [[Member0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMember0()
    {
        return $this->hasOne(People::className(), ['id' => 'member']);
    }

    /**
     * Gets query for [[MemberFrom0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMemberFrom0()
    {
        return $this->hasOne(People::className(), ['id' => 'memberFrom']);
    }
}
