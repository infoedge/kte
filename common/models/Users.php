<?php

namespace common\models;

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
 * @property Sponsorship[] $sponsorships
 * @property Sponsorship[] $sponsorships0
 * @property Tempsponsor $tempsponsor
 * @property Tempsponsor[] $tempsponsors
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
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'verification_token' => 'Verification Token',
            'email' => 'Email',
            'peopleId' => 'People ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Sponsorships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorships()
    {
        return $this->hasMany(Sponsorship::className(), ['ChangedBy' => 'id']);
    }

    /**
     * Gets query for [[Sponsorships0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorships0()
    {
        return $this->hasMany(Sponsorship::className(), ['RecordBy' => 'id']);
    }

    /**
     * Gets query for [[Tempsponsor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTempsponsor()
    {
        return $this->hasOne(Tempsponsor::className(), ['child' => 'id']);
    }

    /**
     * Gets query for [[Tempsponsors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTempsponsors()
    {
        return $this->hasMany(Tempsponsor::className(), ['RecordBy' => 'id']);
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
    public function getPeopleId()
    {
        return $this->peopleId;
    }
}
