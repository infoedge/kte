<?php

namespace app\modules\payments\controllers;

class UtilityController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionShowtime()
    {
        return $this->render('showtime');
    }

}
