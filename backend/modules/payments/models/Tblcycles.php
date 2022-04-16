<?php

namespace backend\modules\payments\models;

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
            [['id', 'member', 'memberFrom', 'earnDate'], 'required'],
            [['id', 'member', 'memberFrom', 'trxBy'], 'integer'],
            [['lft', 'rgt'], 'number'],
            [['earnDate', 'trxDate'], 'safe'],
            [['id'], 'unique'],
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
            'id' => Yii::t('app', 'ID'),
            'member' => Yii::t('app', 'Member'),
            'memberFrom' => Yii::t('app', 'Member From'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'earnDate' => Yii::t('app', 'Earn Date'),
            'trxDate' => Yii::t('app', 'Trx Date'),
            'trxBy' => Yii::t('app', 'Trx By'),
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
