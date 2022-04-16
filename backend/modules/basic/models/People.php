<?php

namespace backend\modules\basic\models;

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
 * @property int $city
 * @property string $dob
 * @property int $gender
 * @property string $phoneNo
 * @property int $recordBy
 * @property string $recordDate
 *
 * @property Contacts[] $contacts
 * @property Inpayments[] $inpayments
 * @property Countries $nationality0
 * @property Identitytypes $identityType
 * @property Titles $title
 * @property Sponsorship $sponsorship
 * @property Sponsorship[] $sponsorships
 * @property Sponsorship[] $sponsorships0
 * @property Tblcycles[] $tblcycles
 * @property Tblcycles[] $tblcycles0
 * @property Tblmatching[] $tblmatchings
 * @property Tblmatching[] $tblmatchings0
 * @property Tblpoints[] $tblpoints
 * @property Tblpoints[] $tblpoints0
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
            [['titleId', 'IdentityType', 'nationality', 'city', 'gender', 'recordBy'], 'integer'],
            [['surname', 'firstName', 'identityNo', 'IdentityType', 'nationality', 'city', 'dob', 'gender', 'phoneNo'], 'required'],
            [['dob', 'recordDate'], 'safe'],
            [['surname', 'otherNames', 'firstName'], 'string', 'max' => 45],
            [['identityNo', 'phoneNo'], 'string', 'max' => 15],
            [['identityNo'], 'unique'],
            [['phoneNo'], 'unique'],
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
            'city' => Yii::t('app', 'City'),
            'dob' => Yii::t('app', 'Date of Birth'),
            'gender' => Yii::t('app', 'Gender'),
            'phoneNo' => Yii::t('app', 'Phone No'),
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
     * Gets query for [[Inpayments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInpayments()
    {
        return $this->hasMany(Inpayments::className(), ['member' => 'id']);
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
        return $this->hasOne(Sponsorship::className(), ['member' => 'id']);
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
     * Gets query for [[Tblcycles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblcycles()
    {
        return $this->hasMany(Tblcycles::className(), ['member' => 'id']);
    }

    /**
     * Gets query for [[Tblcycles0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblcycles0()
    {
        return $this->hasMany(Tblcycles::className(), ['memberFrom' => 'id']);
    }

    /**
     * Gets query for [[Tblmatchings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblmatchings()
    {
        return $this->hasMany(Tblmatching::className(), ['member' => 'id']);
    }

    /**
     * Gets query for [[Tblmatchings0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblmatchings0()
    {
        return $this->hasMany(Tblmatching::className(), ['memberFrom' => 'id']);
    }

    /**
     * Gets query for [[Tblpoints]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblpoints()
    {
        return $this->hasMany(Tblpoints::className(), ['memberFrom' => 'id']);
    }

    /**
     * Gets query for [[Tblpoints0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblpoints0()
    {
        return $this->hasMany(Tblpoints::className(), ['sponsor' => 'id']);
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
    public function getFullName(){
        return $this->title->title.' ' .$this->firstName.( is_Null($this->otherNames)? ' ': ' '.$this->otherNames).' '.$this->surname;
    }
}
