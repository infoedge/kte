<?php

namespace backend\modules\myrbac\controllers;

use Yii;
use yii\web\Controller;
use backend\modules\payments\models\Membershiphistory;

/**
 * Default controller for the `myrbac` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)$this->redirect (['/switchboard/index']);
        if(Yii::$app->request->post('btn')==1){
            $this->start();
        }
        return $this->render('index');
    }
    public function start()
    {
        $userDetails =  Yii::$app->userdetails;
        $auth = Yii::$app->authManager;
        // add "goldReader" permission
        $goldReader = $auth->createPermission('goldReader');
        $goldReader->description = 'Read Gold  Rank Training Material';
        $auth->add($goldReader);
        // add "updatePost" permission
        $diamondReader = $auth->createPermission('diamondReader');
        $diamondReader->description = 'Read Diamond Rank Training Material';
        $auth->add($diamondReader);
        // add "Gold" role and give this role the "createPost" permission
        $gold = $auth->createRole('Gold');
        $auth->add($gold);
        $auth->addChild($gold, $goldReader);
        // add "Diamond" role and give this role the "createPost" permission
        $diamond = $auth->createRole('Diamond');
        $auth->add($diamond);
        $auth->addChild($diamond, $diamondReader);
        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $gold);
        $auth->addChild($admin, $diamond);
        // Assign roles to users. 1 and 2 are IDs returned by
        // IdentityInterface::getId()
        // usually implemented in your User model.
        $mymembers  =Membershiphistory::find()->where(['dateEnd'=>null])->all();
        //Give all members a Diamond or Gold role
        foreach($mymembers as $aMember){
            if($aMember['packageId']==1){
                $auth->assign($gold, $userDetails->getUserParts($aMember['memberId']));
            }elseif($aMember['packageId']==2){
                $auth->assign($diamond, $userDetails->getUserParts($aMember['memberId']));
            }
        }
        
    }
}
