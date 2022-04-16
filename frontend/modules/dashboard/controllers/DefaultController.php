<?php

namespace app\modules\dashboard\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\filters\AccessControl;
use frontend\modules\dashboard\models\Membership;
use frontend\modules\dashboard\models\Dashboard;
use \frontend\modules\payments\models\Sponsorship;

/**
 * Default controller for the `dashboard` module
 */
class DefaultController extends Controller
{
    public $layout = 'dashboard';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','create-link','alter-pref-position'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create-link','alter-pref-position'],
                        'roles' => ['@'],
                    ],
                    
                ],
                /*'denyCallback' => function ($rule, $action) {
                            throw new \Exception('You are not allowed to access this page');
                    }*/
            ],
        ];
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $membership = new Membership();
        $memberDetails = Yii::$app->memberdetails;
        $fmt = \Yii::$app->formatter;
        $model = new Dashboard();
        
        //$mytree = Yii::$app->memberdetails->getTree($membership->memberId);
        $model->position=Url::toRoute(['/site/index', 'sponsor' => $membership->memberNo],true);
        $model->lftside =  '&parent='.$membership->lftChildMemNo.'&lft=';
        $model->rgtside =  '&parent='.$membership->rgtChildMemNo.'&lft=';
         $model->placement = $membership->placement;
        $model->pMethodStr = '&m=2';//use 2nd method for parenting
        if($model->load(Yii::$app->request->post())&& $model->validate()){
            if(Yii::$app->request->post('btn1')==3){
                $memberDetails->setPrefPosition($membership->memberId,$model->placement);;
            }
           // $model->position=Url::toRoute(['/site/join', 'sponsor' => $membership->memberNo, 'parent' => $model->placement==1?$membership->lftChildMemNo:$membership->rgtChildMemNo, 'lft' =>$model->placement ],true);
        }
        return $this->render('index',[
            'membership'=> $membership,
            //'orgchart' => $orgchart,
            'orgchart' => $membership->showArray,
            'parents' => $membership->parents,
            //'mytree' => $mytree,
            'model' => $model,
            'memberDetails' => $memberDetails,
            'fmt' => $fmt,
            //'thehtmltest' =>$thehtmltest,
        ]);
        
    }
    public function actionCreateLink($sponsorNo,$placement){
         $mylink = Jason_encode(Url::to(['/home/join', 'sponsor' => $sponsorNo, 'parent' => 0, 'lft' =>$placement ]));
        echo $mylink;
    }
    
    public function actionAlterPrefPosition($memberno,$pos)
    {
        $model= Sponsorship::find()->where(['membershipNo'=>$memberno])->one();
        $model->prefPosition = $pos;
        $model->save();
        
        //$memberId=Yii::$app->memberdetails->getMemberPartsUsingMemberNo(trim($memberno));
        //Yii::$app->memberdetails->setPrefPosition($memberId,$pos);
        echo 'Preferred position "'.($pos==1?'Left':$pos==2?'Right':'Auto').'" saved';
    }
    
}