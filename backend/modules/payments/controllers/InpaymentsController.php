<?php

namespace app\modules\payments\controllers;

use Yii;
use backend\modules\payments\models\Inpayments;
use backend\modules\payments\models\InpaymentsSearch;
use \backend\modules\payments\models\ConfirmMemberDetails;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Html;


use common\models\Category;
use backend\modules\payments\models\Failedpayreasons;

/**
 * InpaymentsController implements the CRUD actions for Inpayments model.
 */
class InpaymentsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['check-pay', 'confirmpay', 'create','delete','index','update','view','category','update-sponsor','upgrade-sponsor','confirm-member-details','confirm-all-registrations'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['check-pay', 'confirmpay', 'create','delete','index','update','view','category','update-sponsor','upgrade-sponsor','confirm-member-details','confirm-all-registrations'],
                        'roles' => ['admin'],
                    ],
                    
                ],
                /*'denyCallback' => function ($rule, $action) {
                            throw new \Exception('You are not allowed to access this page');
                    }*/
            ],
        ];
    }

    /**
     * Lists all Inpayments models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new InpaymentsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Lists all Inpayments models.
     * @return mixed
     */
    public function actionCheckpay()
    {
        
        $searchModel = new InpaymentsSearch();
        $dataProvider = $searchModel->searchUnpaid(Yii::$app->request->queryParams);

        return $this->render('checkpay', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Inpayments model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Inpayments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Inpayments();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionConfirmMemberDetails()
    {
        $session = Yii::$app->session;
        $model1 = new ConfirmMemberDetails();

        if ($model1->load(Yii::$app->request->post()) && $model1->validate()) {
            $msg = $this->confirmAllRegUpdates($model1->member) ;
            $session->setFlash('success',Html::encode($msg));
            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('confirmMemberDetails', [
            'model' => $model1,
        ]);
    }
    /**
     * 
     * @return type
     */
    public function actionConfirmpay($memberId,$ptype,$package)
    {
        $session = Yii::$app->session;
        $memberDetails = Yii::$app->memberdetails;
        $userDetails = Yii::$app->userdetails;
        $model = Inpayments::find()->where(['member'=>$memberId,'ptype'=>$ptype,'package'=>$package])->one();
        $model->scenario ='confirmpay';
        //$model->confirmed = 0;
        //$model->scenario= 'confirmpay';
        if ($model->load(Yii::$app->request->post())&& $model->validate()) {
            $model->confirmBy = Yii::$app->user->id;
            $model->confirmDate = date('Y-m-d H:i:s');
            $model->save();
            $session->setFlash('success', 'Payment successfully confirmed!');
            if ($model->confirmed && $model->ptype==1/*Registration*/ ) {
                // form inputs are valid, do something here
                
                $this->updateSponsor($model);
                $session->addFlash('success','Registration Successful');//);
            }elseif($model->confirmed && $model->ptype==3/*Upgrade*/){
                
                $this->upgradeSponsor($model);
                $session->addFlash('success','Upgrade Successful');
            }elseif($model->confirmed && $model->ptype==2){
                //subscription
                
                $this->updateSubscription($model);
                $session->addFlash('success','Subscription successfully extended');
            }else{
                $this->logFailedResons($model);
                $session->addFlash('warning','Payment was not confirmed');
            }
            $this->redirect(['checkpay']);
        }

        return $this->render('confirmpay', [
            'model' => $model,
            'memberDetails'=>$memberDetails,
            'userDetails'=>$userDetails,
        ]);
    }

    private function logFailedResons(&$model){
        if($model->dirtyAttributes){
            $mylogModel=new Failedpayreasons();
            $mylogModel->inpaymentId = $model->id;
            $mylogModel->rejectedReason = $model->comments;
            $mylogModel->rejectedDate = $model->confirmDate;
            $mylogModel->rejectedBy =   $model->confirmBy;
            $mylogModel->save();
        }
    }
    /**
     * Updates an existing Inpayments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Inpayments model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Inpayments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Inpayments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Inpayments::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    
    public function addCategory($parentName){
        //if category table is empty create root node;
        $model =new Category();
        if($this->isRootRequired()){
            $model->makeRoot(['name'=>$parentName]);
        }else
            {
                $parent = Category::findOne($parent_id);
                $model->appendTo($parent);
            }
    }
    private function isRootRequired()
    {
        $itemCnt =  (new \yii\db\Query())
                ->select(['*'])
                ->from('category')
                ->count();
        return $itemCnt==0?1:0;
    }
    public function updateSponsor($model){
                
                $msg='';
                $memberDetails=Yii::$app->memberdetails;
                $userDetails = Yii::$app->userdetails;
                $memberId = $model->member;//this is actually userId
                
                $userId = $userDetails->getUserParts($memberId);//Yii::$app->user->id;
                $msg.='UserId: '.$userId;
                // update sponsorship table
                $memberDetails->doAutoMember($model);
                return $msg;
                //$transaction->commit();
                /*}catch(\yii\db\Exception $e){
                    $transaction->rollBack();
                }*/
    }
    public function upgradeSponsor($model){
                $msg='';
                $memberDetails=Yii::$app->memberdetails;
                $userDetails = Yii::$app->userdetails;
                $memberId = $model->member;
                
                $Oldrank = $memberDetails->getMemberPartsUsingPeopleId($memberId,11);//rankId
                $Oldstatus = $memberDetails->getMemberPartsUsingPeopleId($memberId, 10);
                $memberDetails->updMemberHistory($memberId,$model->package,$Oldstatus,$Oldrank,$model->confirmDate,3);
                //update sponsorhip table
                $memberDetails->addRegistrationPoints($memberId,$model->confirmDate,3,1);//level1
                $memberDetails->addRegistrationPoints($memberId,$model->confirmDate,3,2);//level2
                //update binary table
                $memberDetails->addCyclePoints($memberId,3/*3= upgrade */,$model->confirmDate);
                $this->sendMemUpgradeEmail($memberId);
                $this->sendSponsorupgradeEmail($memberId);
                return $msg;
                //$transaction->commit();
                /*}catch(\yii\db\Exception $e){
                    $transaction->rollBack();
                }*/
    }
    public function updateSubscription($model){
                $msg='';
                $memberDetails=Yii::$app->memberdetails;
                //$userDetails = Yii::$app->userdetails;
                $memberId = $model->member;
                $confirmDate = $model->confirmDate;
                $prevrank = $memberDetails->getMemberPartsUsingPeopleId($memberId,11);//rankId
                $prevstatus = $memberDetails->getMemberPartsUsingPeopleId($memberId, 10);
                $memberDetails->updMemberHistory($memberId,$model->package,$prevstatus,$prevrank,$confirmDate,2);
                //$this->sendMemSubsEmail($memberId);
                //$this->sendSponsorSubsEmail($memberId);
                return $msg;
    }
    protected function sendMemConfirmEmail($memberid)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailMemConfirm-html', 'text' => 'emailMemConfirm-text'],
                ['memberid' => $memberid]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->userdetails->getUserParts($memberid,2))
            ->setSubject('Account registration  confirmation at ' . Yii::$app->name)
            ->send();
    }
    protected function sendSponsorDlEmail($memberid)
    {
        $sponsorId = Yii::$app->memberdetails->getMemberPartsUsingPeopleId($memberid,3);
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailDlWelcome-html', 'text' => 'emailDlWelcome-text'],
                ['memberid' => $memberid]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo(Yii::$app->userdetails->getUserParts($sponsorId,2))
            ->setSubject(' A New Member in Your Team at ' . Yii::$app->name)
            ->send();
    }
    public function confirmAllRegUpdates($memberId)
    {
        $memberDetails= Yii::$app->memberdetails;
        $userDetails = Yii::$app->userdetails;
        $msg='';
        //confirm inpayments record
        $model= Inpayments::find()->where(['member'=>$memberId,'ptype'=>1/* Registration */])->one();
        if(!empty($model)){
            //is there a membershiphistory?
            if(empty($memberDetails->getMemberHistory($memberId))){
                //get packId from amount and create member history
                $packId = getPackageFromValue($model->amount,1/*Registration*/);
                $memberDetails->addMemberHistory($memberId,$packId,2/*active*/, 1/*'$ranknew'*/,$model->pdate,1);
                $msg.='Membership History Added <br>';
            }
            $packId = $memberDetails->getMemberHistory($memberId);
            //confirm AuthAssignment
            $userId = $userDetails->getUserParts($memberId);
            $memberDetails->checkAuthAssignment($userId,$packId);
            //confirm RegistrationPoints
            if(!($memberDetails->checkRegistrationPoints($memberId/*id of sponsored members */,$model->pdate,1,1/*level=1*/))){
                $memberDetails->addRegistrationPoints($memberId/*id of sponsored members */,$model->pdate,1,1/*level*/);
                 $msg.='Registration Points Level 1 Added <br>';
            }
            if(!($memberDetails->checkRegistrationPoints($memberId/*id of sponsored members */,$model->pdate,1,2/*level=1*/))){
                $memberDetails->addRegistrationPoints($memberId/*id of sponsored members */,$model->pdate,1,2/*level*/);
                $msg.='Registration Points Level 2 Added <br>';
            }
            //Confirm cyclePoints
            if(!($memberDetails->checkCyclePoints($memberId,1/*register=1; update=3*/,$model->pdate)))
            {
                $memberDetails->addCyclePoints($memberId,1/*register=1; update=3*/,$model->pdate);
                $msg.='Cycle Points Level  Added <br>';
            }
            $model->sendMemConfirmEmail($memberId);
            $msg.='Notification of membership email sent to new member <br>';
            $model->sendSponsorDlEmail($memberId);
            $msg.='Notification of new member email to sponsor sent <br>';
            $memberDetails->refreshTblCyclesBal();
            if(count_chars($msg)==0){
                $msg .='The data was already up to date. No changes made!<br>';
            }
        }else{//no payment found
            $msg.='No payment information found <br>';
        }
        return $msg;
    }
    public function actionConfirmAllRegistrations()
    {
        Yii::$app->audit->confirmAllRegistrations();
    }
}
