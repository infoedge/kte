<?php

namespace backend\modules\basic\models;

use Yii;

/**
 * This is the model class for table "people".
 *
 * @property integer $id
 * @property integer $titleId
 * @property string $surname
 * @property string $otherNames
 * @property string $firstName
 * @property string $identityNo
 * @property integer $IdentityType
 * @property integer $nationality
 * @property string $dob
 * @property integer $gender
 * @property string $kraPin
 * @property integer $recordBy
 * @property string $recordDate
 *
 * @property Contacts[] $contacts
 * @property Employees[] $employees
 * @property Countries $nationality0
 * @property Identitytypes $entityType
 * @property Titles $title
 * @property Studentprerequisites[] $studentprerequisites
 * @property Students[] $students
 * @property User $user
 */
class People extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'people';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['titleId', 'IdentityType', 'nationality', 'gender'], 'integer'],
            [['surname', 'firstName', 'identityNo', 'IdentityType', 'nationality', 'dob', 'gender'], 'required'],
            [['dob', 'recordDate'], 'safe'],
            [['surname', 'otherNames', 'firstName'], 'string', 'max' => 45],
            [['identityNo'], 'string', 'max' => 15],
            [['kraPin'], 'string', 'max' => 11],
            [['identityNo'], 'unique'],
            [['nationality'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['nationality' => 'id']],
            [['IdentityType'], 'exist', 'skipOnError' => true, 'targetClass' => Identitytypes::className(), 'targetAttribute' => ['IdentityType' => 'id']],
            [['titleId'], 'exist', 'skipOnError' => true, 'targetClass' => Titles::className(), 'targetAttribute' => ['titleId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'titleId' => Yii::t('app', 'Title'),
            'surname' => Yii::t('app', 'Surname'),
            'otherNames' => Yii::t('app', 'Other Names'),
            'firstName' => Yii::t('app', 'First Name'),
            'identityNo' => Yii::t('app', 'Identity No'),
            'IdentityType' => Yii::t('app', 'Identity Type'),
            'nationality' => Yii::t('app', 'National Of'),
            'dob' => Yii::t('app', 'Date of Birth (yyyy-mm-dd)'),
            'gender' => Yii::t('app', 'Gender'),
            'kraPin' => Yii::t('app', 'KRA PIN'),
            'recordBy' => Yii::t('app', 'Record By'),
            'recordDate' => Yii::t('app', 'Record Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasMany(Contacts::className(), ['PersonId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::className(), ['peopleId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNationality0()
    {
        return $this->hasOne(Countries::className(), ['id' => 'nationality']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdentityType()
    {
        return $this->hasOne(Identitytypes::className(), ['id' => 'IdentityType']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTitle()
    {
        return $this->hasOne(Titles::className(), ['id' => 'titleId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentprerequisites()
    {
        return $this->hasMany(Studentprerequisites::className(), ['peopleId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['peopleId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['peopleId' => 'id']);
    }
    
    /**
     * 
     * @return type
     */
    public function getFullName(){
        return /*$this->title->title.' ' .*/$this->firstName.( is_Null($this->otherNames)? ' ': ' '.$this->otherNames).' '.$this->surname;
    }
    
    /**
     * 
     * @return type
     */
    public function getContactslist()
    {
        $theList='';
        $models=Contacts::find()->where(['PersonId'=>$this->id])->all();
        foreach($models as $i=>$model){
            $theList.=$model->contactType->contacttypeName=='Email'?'Email'.': '.$model->ContactsValue:'Phone'.': '.$model->ContactsValue.' ;';
            //$theList.=$model->contactType->contacttypeName=='Email'? Html::tag('i', ["class"=>"icon-envelope"]):Html::tag('i', ["class"=>"icon-phone"]).': ' .$model->ContactsValue.' ;';
        }
        return $theList;
    }
}
