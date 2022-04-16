<?php

namespace backend\modules\myrbac\controllers;

class PermissionnotgrantedController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
