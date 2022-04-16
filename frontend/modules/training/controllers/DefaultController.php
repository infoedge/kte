<?php

namespace app\modules\training\controllers;

use Yii;
use yii\web\Controller;

/**
 * Default controller for the `training` module
 */
class DefaultController extends Controller
{
    public $layout = '@app/views/layouts/mainpdf';
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
