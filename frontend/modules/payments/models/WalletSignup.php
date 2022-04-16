<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\payments\models;

/**
 * Description of WalletSignup
 *
 * @author Apache1
 */
use Yii;
use yii\base\Model;
use common\models\Wtuser;
use common\mail;

class WalletSignup extends Model{
    
    //public $username;
    //public $email;
    //public $email_repeat;
    public $password;
    public $password_repeat;
    //public $sponsor;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            /*['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            */
//            [['email' ,'email_repeat'], 'trim'],
//            [['email','email_repeat' ], 'required'],
//            ['email', 'email'],
//            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
//
//            ['email_repeat', 'compare', 'compareAttribute' => 'email'],

            [['password', 'password_repeat'], 'required'],
            //['password','compare'],
            ['password', 'string', 'min' => 8],
            //['password','match','pattern'=>['\^([A-Za-z]{1})?([A-Za-z0-9!*@-_%&?+])+$/']],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            
//            ['sponsor', 'required'],
//            ['sponsor', 'integer'],
//            ['sponsor','exist','targetClass'=>Sponsorship::class,'targetAttribute' =>['sponsor'=>'membershipNo']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new Wtuser();
        //$user->username = $this->email;
        //$user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->userId = Yii::$app->user->id;
        $user->peopleId = Yii::$app->userdetails->getPersonId($user->userId);
        $user->generateEmailVerificationToken();
        $user->save() && $this->sendEmail($user);
//        $this->saveSponsor(  $this->sponsor);
        return true;
    }
    

    public function attributeLabels()
    {
        return [
            'sponsor' => 'Sponsor\'s ID',
            'email_repeat' => 'Confirm Email',
            'password_repeat' => 'Confirm Password',
            'username' => 'E-mail'
        ];
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'wemailVerify-html', 'text' => 'wemailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Wallet Password registration at ' . Yii::$app->name)
            ->send();
    }
}
