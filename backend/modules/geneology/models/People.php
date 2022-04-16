<?php

namespace backend\modules\genealogy\models;

use Yii;

/**
 * This is the model class for table "people".
 *
 * @property int $id
 * @property int|null $titleId
 * @property string $surname
 * @property string|null $otherNames
 * @property string $firstName
 * @property string $identityNo
 * @property int $IdentityType
 * @property int $nationality
 * @property string $dob
 * @property int $gender
 * @property string|null $kraPin incomeTaxNo
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property Contacts[] $contacts
 * @property Countries $nationality0
 * @property Identitytypes $identityType
 * @property Titles $title
 * @property Sponsorship $sponsorship
 * @property Sponsorship[] $sponsorships
 * @property Sponsorship[] $sponsorships0
 * @property Tempsponsor[] $tempsponsors
 * @property User $user
 */
class People extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'people';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titleId', 'IdentityType', 'nationality', 'gender', 'recordBy'], 'integer'],
            [['surname', 'firstName', 'identityNo', 'IdentityType', 'nationality', 'dob', 'gender', 'recordBy', 'recordDate'], 'required'],
            [['dob', 'recordDate'], 'safe'],
            [['surname', 'otherNames', 'firstName'], 'string', 'max' => 45],
            [['identityNo'], 'string', 'max' => 15],
            [['kraPin'], 'string', 'max' => 12],
            [['identityNo'], 'unique'],
            [['nationality'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['nationality' => 'id']],
            [['IdentityType'], 'exist', 'skipOnError' => true, 'targetClass' => Identitytypes::className(), 'targetAttribute' => ['IdentityType' => 'id']],
            [['titleId'], 'exist', 'skipOnError' => true, 'targetClass' => Titles::className(), 'targetAttribute' => ['titleId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titleId' => Yii::t('app', 'Title ID'),
            'surname' => Yii::t('app', 'Surname'),
            'otherNames' => Yii::t('app', 'Other Names'),
            'firstName' => Yii::t('app', 'First Name'),
            'identityNo' => Yii::t('app', 'Identity No'),
            'IdentityType' => Yii::t('app', 'Identity Type'),
            'nationality' => Yii::t('app', 'Nationality'),
            'dob' => Yii::t('app', 'Dob'),
            'gender' => Yii::t('app', 'Gender'),
            'kraPin' => Yii::t('app', 'Kra Pin'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['PersonId' => 'id']);
    }

    /**
     * Gets query for [[Nationality0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNationality0()
    {
        return $this->hasOne(Countries::className(), ['id' => 'nationality']);
    }

    /**
     * Gets query for [[IdentityType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdentityType()
    {
        return $this->hasOne(Identitytypes::className(), ['id' => 'IdentityType']);
    }

    /**
     * Gets query for [[Title]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTitle()
    {
        return $this->hasOne(Titles::className(), ['id' => 'titleId']);
    }

    /**
     * Gets query for [[Sponsorship]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorship()
    {
        return $this->hasOne(Sponsorship::className(), ['child' => 'id']);
    }

    /**
     * Gets query for [[Sponsorships]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorships()
    {
        return $this->hasMany(Sponsorship::className(), ['parent' => 'id']);
    }

    /**
     * Gets query for [[Sponsorships0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSponsorships0()
    {
        return $this->hasMany(Sponsorship::className(), ['sponsor' => 'id']);
    }

    /**
     * Gets query for [[Tempsponsors]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTempsponsors()
    {
        return $this->hasMany(Tempsponsor::className(), ['sponsor' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['peopleId' => 'id']);
    }
    public function getFullName()
    {
        return  $this->firstName.' '.$this->surname;
    }
    public function getFullNameAndEmail()
    {
        return  $this->firstName.' '.$this->surname.'; ('.$this->user->email.')';
    }
}
