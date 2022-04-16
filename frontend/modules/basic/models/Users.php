<?php

namespace frontend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property int|null $peopleId
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $password
 *
 * @property People $people
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'verification_token', 'email', 'created_at', 'updated_at', 'password'], 'required'],
            [['peopleId', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'verification_token', 'email', 'password'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['peopleId'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['peopleId'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['peopleId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'email' => Yii::t('app', 'Email'),
            'peopleId' => Yii::t('app', 'People ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'password' => Yii::t('app', 'Password'),
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
     * @return \yii\db\ActiveQuery
     */
    
    public function setPeopleId($personID){
       return $this->peopleId = $personID;
    }
}
