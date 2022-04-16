<?php

namespace frontend\controllers;

use Yii;

class HomeController extends \yii\web\Controller
{
    public $layout = 'fullpage';
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionContact()
    {
        return $this->render('contact');
    }

    public function actionFaq()
    {
        return $this->render('faq');
    }

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
        return $this->render('index');
    }

    public function actionOpprtunity()
    {
        return $this->render('opprtunity');
    }

    public function actionServices()
    {
        return $this->render('services');
    }

}
