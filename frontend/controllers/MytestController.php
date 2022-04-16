<?php

namespace frontend\controllers;

class MytestController extends \yii\web\Controller
{
    public $layout = 'main_wide';
    public function actionHome()
    {
        return $this->render('home');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
