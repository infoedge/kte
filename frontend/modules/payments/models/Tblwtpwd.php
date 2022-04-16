<?php

namespace frontend\modules\payments\models;

use Yii;

/**
 * This is the model class for table "tblwtpwd".
 *
 * @property int $id
 * @property int $userId
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $verification_token
 * @property int $peopleId
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 *
 * @property People $people
 * @property User $user
 */
class Tblwtpwd extends \yii\db\ActiveRecord
{
    public $pwd;
    public $pwd_repeat;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblwtpwd';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pwd'],'required'],
            ['pwd_repeat', 'compare', 'compareAttribute' => 'pwd'],
            //[['userId', 'auth_key', 'password_hash', 'verification_token', 'peopleId', 'created_at', 'updated_at'], 'required'],
            [['userId', 'peopleId', 'status', 'created_at', 'updated_at'], 'integer'],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['userId'], 'unique'],
            [['peopleId'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['peopleId'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['peopleId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'userId' => Yii::t('app', 'User ID'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'peopleId' => Yii::t('app', 'People ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[People]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasOne(People::className(), ['id' => 'peopleId']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'userId']);
    }
}
