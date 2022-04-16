<?php

namespace app\modules\dashboard\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\filters\AccessControl;
use backend\modules\dashboard\models\Membership;
use backend\modules\dashboard\models\Dashboard;
use \backend\modules\dashboard\models\Sponsorship;
use \backend\modules\dashboard\models\Memberselect;

/**
 * Default controller for the `dashboard` module
 */
class DefaultController extends Controller {

    public $layout = 'dashboardbe';

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create-link', 'alter-pref-position','check-pack-id','check-amount-payable','check-fully-sponsored','check-lft-sponsored','check-rgt-sponsored'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'create-link', 'alter-pref-position','check-pack-id','check-amount-payable','check-fully-sponsored','check-lft-sponsored','check-rgt-sponsored'],
                        'roles' => ['admin'],
                    ],
                ],
            /* 'denyCallback' => function ($rule, $action) {
              throw new \Exception('You are not allowed to access this page');
              } */
            ],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex($memberId) {
        $memberDetails = Yii::$app->memberdetails;
        //$userDetails=Yii::$app->userdetails;
        $membership = new Membership();
        $membership->startup($memberId);//populates values in membership
        
        $fmt = \Yii::$app->formatter;
        $model = new Dashboard();

        //$mytree = Yii::$app->memberdetails->getTree($membership->memberId);
        $model->position = Url::toRoute(['/site/index', 'sponsor' => $membership->memberNo], true);
        $model->lftside = '&parent=' . $membership->lftChildMemNo . '&lft=';
        $model->rgtside = '&parent=' . $membership->rgtChildMemNo . '&lft=';
        $model->placement = $membership->placement;
        $model->pMethodStr = '&m=2'; //use 2nd method for parenting
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if (Yii::$app->request->post('btn1') == 3) {
                $memberDetails->setPrefPosition($membership->memberId, $model->placement);
                ;
            }
            // $model->position=Url::toRoute(['/site/join', 'sponsor' => $membership->memberNo, 'parent' => $model->placement==1?$membership->lftChildMemNo:$membership->rgtChildMemNo, 'lft' =>$model->placement ],true);
        }
        return $this->render('index', [
                    'membership' => $membership,
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

    public function actionCreateLink($sponsorNo, $placement) {
        $mylink = Jason_encode(Url::to(['/site/join', 'sponsor' => $sponsorNo, 'parent' => 0, 'lft' => $placement]));
        echo $mylink;
    }

    public function actionAlterPrefPosition($memberno, $pos) {
        $model = Sponsorship::find()->where(['membershipNo' => $memberno])->one();
        $model->prefPosition = $pos;
        $model->save();

        //$memberId=Yii::$app->memberdetails->getMemberPartsUsingMemberNo(trim($memberno));
        //Yii::$app->memberdetails->setPrefPosition($memberId,$pos);
        echo 'Preferred position "' . ($pos == 1 ? 'Left' : $pos == 2 ? 'Right' : 'Auto') . '" saved';
    }

    public function actionMemberselect() {
        $session = Yii::$app->session;
        $model = new Memberselect();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                $session['memberId']= $model->member;
                return $this->redirect(['index','memberId'=>$model->member]);
            }
        }

        return $this->render('memberselect', [
                    'model' => $model,
        ]);
    }
    public function actionCheckPackId($memberId)
    {
        $memberDetails = Yii::$app->memberdetails;
        $theDate = date('Y-m-d H:i:s');
        $value = $memberDetails->getMembershipHistory($memberId,$theDate,4);
        echo Json::encode($value);
    }
    
    public function actionCheckCyclePoints($packId,$trxId=1)
    {
        $memberDetails = Yii::$app->memberdetails;
        
        $value = $memberDetails->getPackageConfig($packId,$trxId, 3);
        echo Json::encode($value);
    }
    public function actionCheckFullySponsored($memberId)
    {
        $memberDetails = Yii::$app->memberdetails;
        $theDate = date('Y-m-d H:i:s');
        $value = $memberDetails->sponsoringDetails($memberId,$theDate, 2);
        echo Json::encode($value);
    }
    public function actionCheckLftSponsored($memberId)
    {
        $memberDetails = Yii::$app->memberdetails;
        $theDate = date('Y-m-d H:i:s');
        $value = $memberDetails->sponsoringDetails($memberId,$theDate, 3);
        echo Json::encode($value);
    }
    public function actionCheckRgtSponsored($memberId)
    {
        $memberDetails = Yii::$app->memberdetails;
        $theDate = date('Y-m-d H:i:s');
        $value = $memberDetails->sponsoringDetails($memberId,$theDate, 4);
        echo Json::encode($value);
    }
}
