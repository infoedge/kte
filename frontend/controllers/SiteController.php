<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UrlManager;
use yii\helpers\Url;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use \frontend\models\Refmodel;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup','help'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','help'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex($sponsor='',$parent='',$lft='',$m=2)
    {
        $session=  Yii::$app->session;
        $request = Yii::$app->request;
        $memberDetails =Yii::$app->memberdetails;
        if(!$session->isActive  ){$session->open();}
        if( !empty($request->get('sponsor'))){
            Yii::$app->session['sponsor']=$sponsor;
            Yii::$app->session['parent']=$parent;
            Yii::$app->session['lft']=$lft;
            Yii::$app->session['m']=$m;
            if(!Yii::$app->user->isGuest){   Yii::$app->user->logout();}
        }
        
        $memberid = $memberDetails->getMemberPartsUsingMemberNo($sponsor);
        $memberName = $memberDetails->getMemberPartsUsingPeopleId($memberid,6);
//        Url::remember(['site/join','sponsor'=>$sponsor,'parent'=>$parent,'lft'=>$lft,'m'=>$m]);
        //Yii::$app-> registerMetaTag('This is about learning practical lessons and earning either by carrying out those lessons or engaging in our referral/ affiliate program', 'home');
        return $this->render('index',[
            'sponsor'=> $sponsor,
            'memberName' => $memberName,
        ]);
    }

    /**
     * Displays events page.
     *
     * @return mixed
     */
    public function actionEvents()
    {
        $refmodel = new Refmodel();
        
        
        //Yii::$app->clientScript->registerMetaTag('What\'s happening on the knowledge-to-earn scenario', 'Events');
        return $this->render('events',[
            'refmodel'=>$refmodel,
        ]);
    }

    /**
     * Displays events page.
     *
     * @return mixed
     */
    public function actionHelp()
    {
        $refmodel = new Refmodel();
        
        
        //Yii::$app->clientScript->registerMetaTag('What\'s happening on the knowledge-to-earn scenario', 'Events');
        return $this->render('help',[
            'refmodel'=>$refmodel,
        ]);
    }
    /**
     * Displays events page.
     *
     * @return mixed
     */
    public function actionPrivacypolicy()
    {
        $refmodel = new Refmodel();
        
        return $this->render('privacypolicy',[
            'refmodel'=>$refmodel,
        ]);
        
    }
    
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login() && empty(Yii::$app->userdetails->getPersonId(Yii::$app->user->id))){
            Yii::$app->session['backlink']='/dashboard/default/index';
            return $this->redirect(['basic/people/create']);
        } elseif ($model->load(Yii::$app->request->post()) && $model->login() && !empty(Yii::$app->userdetails->getPersonId(Yii::$app->user->id)) 
                //&& !Yii::$app->memberdetails->isRegistered(Yii::$app->userdetails->getPersonId(Yii::$app->user->id))
                && Yii::$app->memberdetails->isInpaymentsFilled(Yii::$app->userdetails->getPersonId(Yii::$app->user->id),1)==-1
                
                ) {
                    return $this->redirect(['payments/inpayments/packregistration','member'=>Yii::$app->userdetails->getPersonId(Yii::$app->user->id)]);
        }elseif ($model->load(Yii::$app->request->post()) && $model->login() && !empty(Yii::$app->userdetails->getPersonId(Yii::$app->user->id)) 
                //&& Yii::$app->memberdetails->isRegistered(Yii::$app->userdetails->getPersonId(Yii::$app->user->id),2)
                //&& empty(Yii::$app->memberdetails->isInpaymentsFilled(Yii::$app->userdetails->getPersonId(Yii::$app->user->id),5))// Not confirmed
                && (Yii::$app->memberdetails->memberHasHistory(Yii::$app->userdetails->getPersonId(Yii::$app->user->id))==false)
                )
                {
            return $this->redirect(['payments/inpayments/awaitapproval','member'=>Yii::$app->userdetails->getPersonId(Yii::$app->user->id)]);
        }elseif ($model->load(Yii::$app->request->post()) && $model->login() && !empty(Yii::$app->userdetails->getPersonId(Yii::$app->user->id))) {
            return $this->redirect(['dashboard/default/index']);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionTermsandconditions()
    {
        return $this->render('termsandconditions');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        $refmodel = new Refmodel();
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
                'refmodel'=>$refmodel,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        
        $refmodel = new Refmodel();
        
        return $this->render('about',[
            'refmodel'=>$refmodel,
        ]);
    }

    
    /**
     * Displays products page.
     *
     * @return mixed
     */
    public function actionOpportunityDetails()
    {
        $refmodel = new Refmodel();
        
        return $this->render('opportunitydetails',[
            'refmodel'=>$refmodel,
        ]);
        
    }
    
    /**
     * Displays products page.
     *
     * @return mixed
     */
    public function actionOpportunity()
    {
        $refmodel = new Refmodel();
        
        return $this->render('opportunity',[
            'refmodel'=>$refmodel,
        ]);
        
    }
    
    /**
     * Displays products page.
     *
     * @return mixed
     */
    public function actionHomepage()
    {
        $refmodel = new Refmodel();
        
        return $this->render('homepage',[
            'refmodel'=>$refmodel,
        ]);
        
    }
    
    /**
     * Displays services page.
     *
     * @return mixed
     */
    public function actionServices()
    {
        $refmodel = new Refmodel();
        
        return $this->render('services',[
            'refmodel'=>$refmodel,
        ]);

    }
    
    /**
     * Displays FAQ page.
     *
     * @return mixed
     */
    public function actionFaq()
    {
        $refmodel = new Refmodel();
        
        return $this->render('faq',[
            'refmodel'=>$refmodel,
        ]);
        
    }
    
    public function actionServicesSummary()
    {
        $layout = 'mainpdf';
        $refmodel = new Refmodel();
        
        return $this->render('servicesSummary',[
            'refmodel'=>$refmodel,
        ]);
        
    }
    
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup($sponsor='')
    {
        $refmodel = new Refmodel();
         $model = new SignupForm();
        
       
        
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            /// to be removed
            //$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
            ///
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            //Yii::$app->addFlash('warning','click the link '.$verifyLink.'to confirm sign-up');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
            'refmodel' =>$refmodel,
        ]);
    }

    /**
     * Signs up user with a sponsor.
     *
     * @return mixed
     */
    public function actionJoin($sponsor='',$parent='',$lft=1,$m=1)
    {
        
        $session = Yii::$app->session;
        $refmodel = new Refmodel();
        if($session->isActive){
            $sponsor = $refmodel->sponsor;
            $parent = $refmodel->parent;
            $lft = $refmodel->lft;
            $m=$refmodel->m;
        }
        $model = new SignupForm();
        $model->sponsor= $sponsor;
        
        
        
        //if(empty($sponsor)&&!empty($session['sponsor'])){$model->sponsor= $session['sponsor'];}
        if ($model->load(Yii::$app->request->post()) && $model->join($sponsor,$parent,$lft,$m)) {
            /// to be removed
            //$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->verification_token]);
            ///
            $session->destroy();
            $session->close();
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            //Yii::$app->addFlash('warning','click the link '.$verifyLink.'to confirm sign-up');
            return $this->goHome();
        }

        return $this->render('join', [
            'model' => $model,
            'refmodel'=>$refmodel,
        ]);
    }
    
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user) && empty(Yii::$app->userdetails->getPersonId(Yii::$app->user->id))) {
                Yii::$app->user->logout();
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->redirect(['/site/login']);
            }else{
                
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
