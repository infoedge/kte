<?php

namespace app\modules\dashboard\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use yii\helpers\Json;
use yii\filters\AccessControl;
use backend\modules\dashboard\models\Membership;
use backend\modules\dashboard\models\Sponsorship;
use backend\modules\dashboard\models\SponsorshipSearch;
use backend\modules\dashboard\models\Dashboard;
use \backend\modules\dashboard\models\Placement;
use \yii\data\SqlDataProvider;
use \backend\modules\dashboard\models\Genealogy;
use backend\modules\dashboard\models\Tblcycles;
use backend\modules\dashboard\models\TblcyclesSearch;
use backend\modules\dashboard\models\MembershiphistorySearch;
use backend\modules\dashboard\models\TblpointsSearch;
use backend\modules\dashboard\models\TblcycleearningsSearch;
use backend\modules\dashboard\models\TblmatchingSearch;
use backend\modules\dashboard\models\TblrankearningsSearch;

class MembershipController extends \yii\web\Controller
{
    public $layout = 'dashboardbe';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['commissions', 'genealogy', 'myteam','subscribe','upgrade','volumehistory','placement','trainiing','memberprofile','newsfeed','ranks'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['commissions', 'genealogy', 'myteam','subscribe','upgrade','volumehistory','placement','trainiing','memberprofile','newsfeed','ranks'],
                        'roles' => ['@'],
                    ],
                    
                ],
                /*'denyCallback' => function ($rule, $action) {
                            throw new \Exception('You are not allowed to access this page');
                    }*/
            ],
        ];
    }
    
    public function actionGenealogy3()
    {
        $session= Yii::$app->session;
        $membership = new Membership();
        $model = new Dashboard();
        $memberDetails = Yii::$app->memberdetails;
        $placement= new Placement();
        $placement->sponsor = $membership->memberNo;
        $placement->pos = 1;
        $placement->methodstr =3;
        $placement->homelnk  = Url::home(true);
        //$placement->pos = $memberDetails->get
        $genealogy = new Genealogy();
        $genealogy->cntrlArr=array();
        //$theTree = $memberDetails->getTreeDetails($membership->memberId);
        $genealogy->treeArr = $memberDetails->displayTree($membership->memberId);
        //$genealogy->treeArr = $memberDetails->getTreeArray($membership->memberId, $theTree,$genealogy->cntrlArr );
        //unset($genealogy->treeArr[0]);
        
        //$genealogy->aTree = $memberDetails->parseTree($genealogy->treeArr,$membership->memberId);
        
        //$memberDetails->prepareTree($genealogy->aTree,$genealogy->treeList);
        //$memberDetails->parseAndPrepareTree($membership->memberId,$genealogy->cntrlArr,$genealogy->treeArr,$genealogy->treeList);
        //$mytree = $memberDetails->getFullTree($membership->memberId);
        //$model->position=Url::toRoute(['/site/join', 'sponsor' => $membership->memberNo],true);
        //$model->lftside =  '&parent='.$membership->lftChildMemNo.'&lft=';
        //$model->rgtside =  '&parent='.$membership->rgtChildMemNo.'&lft=';
        if($model->load(Yii::$app->request->post())&& $model->validate()){
           // $model->position=Url::toRoute(['/site/join', 'sponsor' => $membership->memberNo, 'parent' => $model->placement==1?$membership->lftChildMemNo:$membership->rgtChildMemNo, 'lft' =>$model->placement ],true);
        }
        return $this->render('genealogy',[
            'membership'=> $membership,
            //'orgchart' => $orgchart,
            //'orgchart' => $membership->showArray,
            //'parents' => $membership->parents,
            //'mytree' => $mytree,
            'placement' => $placement,
            'model' => $model,
            'memberDetails'=>$memberDetails,
            'genealogy' => $genealogy,
            
            //'thehtmltest' =>$thehtmltest,
        ]);
       
    }
    public function actionPlacement($sponsor='',$parent='',$lft=3)
    {
        $model = new Placement();
        $model->sponsor=$sponsor;
        $model->parent=$parent;
        $model->pos=$lft;
        $model->homelnk = Url::to(['/site/index'],'https', true);
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                // form inputs are valid, do something here
                return $this->redirect(['/site/index','sponsor'=>$model->sponsor,'parent'=>$model->parent,'lft'=>$model->pos]);
            }
        }

        return $this->renderAjax('placement', [
            'model' => $model,
        ]);
    }


    public function actionMyteam($memberId)
    {
        //$session= Yii::$app->session;
        $memberDetails=Yii::$app->memberdetails;
        $membership = new Membership();
        $membership->startup($memberId);
        $searchModel = new SponsorshipSearch();
        $dataProvider = $searchModel->searchBySponsor($membership->memberId,Yii::$app->request->queryParams);
        return $this->render('myteam',[
           'searchModel'=>$searchModel,
           'dataProvider'=>$dataProvider,
            'membership' => $membership,
        ]);
    }

    public function actionSubscribe()
    {
        //$memberDetails= Yii::$app->memberdetails;
        $session= Yii::$app->session;
        $membership = new Membership();
        return $this->render('subscribe',[
            'membership' => $membership,
            
        ]);
    }

    public function actionUpgrade()
    {
        $session= Yii::$app->session;
        $membership = new Membership();
        return $this->render('upgrade',[
                'membership'=> $membership,
                ]);
    }

    public function actionComissions($memberId)
    {
        $session= Yii::$app->session;
        $memberDetails= Yii::$app->memberdetails;
        $fmt = \Yii::$app->formatter;
        $membership = new Membership();
        $membership->startup($memberId);
        $searchModel = new TblpointsSearch();
        $dataProvider = $searchModel->searchByMember($membership->memberId,Yii::$app->request->queryParams);
        $searchModel2 = new TblcycleearningsSearch();
        $dataProvider2 = $searchModel2->searchByMember($membership->memberId,Yii::$app->request->queryParams);
        $searchModel3 = new TblmatchingSearch();
        $dataProvider3 = $searchModel3->searchByMember($membership->memberId,Yii::$app->request->queryParams);
        $searchModel4 = new TblrankearningsSearch();
        $dataProvider4 = $searchModel4->searchByMember($membership->memberId,Yii::$app->request->queryParams);
        if(Yii::$app->request->post('btn')==1){
            $memberDetails->trxPointsToWallet($membership->memberId);
        }elseif(Yii::$app->request->post('btn')==2){
            $memberDetails->trxCycleEarningsToWallet($membership->memberId);
        }if(Yii::$app->request->post('btn')==3){
            $memberDetails->trxMatchingToWallet($membership->memberId);
        }
        return $this->render('comissions', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'searchModel2' => $searchModel2,
            'dataProvider2' => $dataProvider2,
            'searchModel3' => $searchModel3,
            'dataProvider3' => $dataProvider3,
            'searchModel4' => $searchModel4,
            'dataProvider4' => $dataProvider4,
            'membership' =>$membership,
            'fmt'=>$fmt,
        ]);
        
    }
    public function actionGenealogy($memberId)
    {
        $session= Yii::$app->session;
        $membership = new Membership();
        $membership->startup($memberId);
        $memberDetails = Yii::$app->memberdetails;
        $placement = new Placement();
        $placement->methodstr = 3;
        $themember = $memberId;
        //get currentmember
        $cm = $session['memberId'];//Yii::$app->userdetails->getPersonId(Yii::$app->user->id);
        $curMem = new Membership();
        $curMem->startup($cm);
        $genealogy = $this->populateTree($themember, $membership,$cm);
        return $this->render('genealogy',[
            'genealogy'=> $genealogy,
            'memberDetails' =>$memberDetails,
            'placement' => $placement,
            'membership' => $membership,
            'curMem' => $curMem,
            //'anArr'=>$anArr,
        ]);
    }
    public function actionMemberprofile()
    {
        $session= Yii::$app->session;
        $membership = new Membership();
        return $this->render('memberprofile');
    }
    public function actionTraining()
    {
        $session= Yii::$app->session;
        $membership = new Membership();
        return $this->render('training');
    }
    public function actionNewsfeed()
    {
        $session= Yii::$app->session;
        $membership = new Membership();
        return $this->render('newsfeed');
    }
    public function actionVolumehistory($memberId)
    {
        $session= Yii::$app->session;
        $membership = new Membership();
        $membership->startup($memberId);
        $searchModel = new TblcyclesSearch();
        $dataProvider = $searchModel->searchByMember($membership->memberId,Yii::$app->request->queryParams);

       
        return $this->render('volumehistory',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'membership' =>$membership,
        ]);
    }
    public function actionRanks()
    {
        $session= Yii::$app->session;
        $membership = new Membership();
        $searchModel = new MembershiphistorySearch();
        $dataProvider = $searchModel->searchByMember($membership->memberId,Yii::$app->request->queryParams);

        return $this->render('ranks', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
       
    }
    
    public function populateTree($memberId,$membership, $currentMember)
    {
        $memberDetails = Yii::$app->memberdetails;
        $genealogy = new Genealogy();
        $genealogy->treeArr= $memberDetails->getTreeDetails($membership->memberId);
        $genealogy->aTree = $memberDetails->getTreeArray($membership->memberId,$genealogy->treeArr,$genealogy->cntrlArr);
        $trialArr = $genealogy->cntrlArr;
        $genealogy->parsedArr = $memberDetails->to_tree($trialArr); //$memberDetails->parseTree($trialArr,$membership->memberId);
        $memberDetails->prepTree($membership->memberId,$genealogy->parsedArr,$genealogy->aTree,$genealogy->treeList,$currentMember);
        return  $genealogy;
    }
   
}
