<?php

namespace backend\modules\reports\models;

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
 * @property Commissions[] $commissions
 * @property Contacts[] $contacts
 * @property Inpayments[] $inpayments
 * @property Countries $nationality0
 * @property Identitytypes $identityType
 * @property Titles $title
 * @property Sponsorship $sponsorship
 * @property Sponsorship[] $sponsorships
 * @property Sponsorship[] $sponsorships0
 * @property Tblcycleearnings[] $tblcycleearnings
 * @property Tblcycles[] $tblcycles
 * @property Tblcycles[] $tblcycles0
 * @property Tblcyclesbal[] $tblcyclesbals
 * @property Tblcyclesmis[] $tblcyclesmis
 * @property Tblcyclesmis[] $tblcyclesmis0
 * @property Tblfundstransfer[] $tblfundstransfers
 * @property Tblfundstransfer[] $tblfundstransfers0
 * @property Tblgcodes[] $tblgcodes
 * @property Tblgcodes[] $tblgcodes0
 * @property Tblmatching[] $tblmatchings
 * @property Tblmatching[] $tblmatchings0
 * @property Tblpoints[] $tblpoints
 * @property Tblpoints[] $tblpoints0
 * @property Tblpointsmis[] $tblpointsmis
 * @property Tblpointsmis[] $tblpointsmis0
 * @property Tblrankearnings[] $tblrankearnings
 * @property User $user
 * @property Wallet[] $wallets
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
            [['surname', 'firstName', 'identityNo', 'IdentityType', 'nationality', 'city', 'dob', 'gender', 'phoneNo', 'recordBy', 'recordDate'], 'required'],
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
            'id' => 'ID',
            'titleId' => 'Title ID',
            'surname' => 'Surname',
            'otherNames' => 'Other Names',
            'firstName' => 'First Name',
            'identityNo' => 'Identity No',
            'IdentityType' => 'Identity Type',
            'nationality' => 'Nationality',
            'city' => 'City',
            'dob' => 'Dob',
            'gender' => 'Gender',
            'phoneNo' => 'Phone No',
            'recordBy' => 'Record By',
            'recordDate' => 'Record Date',
        ];
    }

    /**
     * Gets query for [[Commissions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCommissions()
    {
        return $this->hasMany(Commissions::className(), ['member' => 'id']);
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
     * Gets query for [[Tblcycleearnings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblcycleearnings()
    {
        return $this->hasMany(Tblcycleearnings::className(), ['member' => 'id']);
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
     * Gets query for [[Tblcyclesbals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblcyclesbals()
    {
        return $this->hasMany(Tblcyclesbal::className(), ['member' => 'id']);
    }

    /**
     * Gets query for [[Tblcyclesmis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblcyclesmis()
    {
        return $this->hasMany(Tblcyclesmis::className(), ['member' => 'id']);
    }

    /**
     * Gets query for [[Tblcyclesmis0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblcyclesmis0()
    {
        return $this->hasMany(Tblcyclesmis::className(), ['memberFrom' => 'id']);
    }

    /**
     * Gets query for [[Tblfundstransfers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblfundstransfers()
    {
        return $this->hasMany(Tblfundstransfer::className(), ['memberFrom' => 'id']);
    }

    /**
     * Gets query for [[Tblfundstransfers0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblfundstransfers0()
    {
        return $this->hasMany(Tblfundstransfer::className(), ['memberTo' => 'id']);
    }

    /**
     * Gets query for [[Tblgcodes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblgcodes()
    {
        return $this->hasMany(Tblgcodes::className(), ['retrieveBy' => 'id']);
    }

    /**
     * Gets query for [[Tblgcodes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblgcodes0()
    {
        return $this->hasMany(Tblgcodes::className(), ['memberGen' => 'id']);
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
     * Gets query for [[Tblpointsmis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblpointsmis()
    {
        return $this->hasMany(Tblpointsmis::className(), ['memberFrom' => 'id']);
    }

    /**
     * Gets query for [[Tblpointsmis0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblpointsmis0()
    {
        return $this->hasMany(Tblpointsmis::className(), ['sponsor' => 'id']);
    }

    /**
     * Gets query for [[Tblrankearnings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblrankearnings()
    {
        return $this->hasMany(Tblrankearnings::className(), ['member' => 'id']);
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

    /**
     * Gets query for [[Wallets]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWallets()
    {
        return $this->hasMany(Wallet::className(), ['member' => 'id']);
    }
    public function getFullName(){
        return $this->title->title.' ' .$this->firstName.( is_Null($this->otherNames)? ' ': ' '.$this->otherNames).' '.$this->surname;
    }
}
