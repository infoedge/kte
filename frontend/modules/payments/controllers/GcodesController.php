<?php

namespace app\modules\payments\controllers;

use Yii;
use frontend\modules\payments\models\Tblgcodes;
use frontend\modules\payments\models\TblgcodesSearch;
use frontend\modules\dashboard\models\Membership;
use frontend\modules\payments\models\Packconfig;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

/**
 * TblgcodesController implements the CRUD actions for Tblgcodes model.
 */
class GcodesController extends Controller
{
    public $layout = 'dashboard';
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
                'only' => ['awaitapproval', 'create', 'index','pack-value','packregistration','reactivate','update','upgrade','view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['awaitapproval', 'create', 'index','pack-value','packregistration','reactivate','update','upgrade','view'],
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
     * Lists all Tblgcodes models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblgcodesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblgcodes model.
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
     * Creates a new Tblgcodes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $useful = Yii::$app->useful;
        $memberDetails = Yii::$app->memberdetails;
        $membership = new Membership();
        //$myarr = $memberDetails->getPackConfigOptions();
        $myarr = $memberDetails->getPackConfigOptions(2);//no subscription
        $searchModel = new TblgcodesSearch();
        $dataProvider = $searchModel->searchByMemberId($membership->memberId,Yii::$app->request->queryParams);
        
        $model = new Tblgcodes();

        if ($model->load(Yii::$app->request->post())&& $model->validate() ) {
            try{
                $model->amount = $memberDetails->getPackConfigItemsById($model->packconfigId);
                $model->code = $memberDetails->getPackConfigItemsById($model->packconfigId,2).time();
                $model->memberGen = $membership->memberId;
                $model->dateGen=date('Y-m-d H:i:s');
                $model->expiryDate = $useful->addDateInterval($model->dateGen,$memberDetails->getAppConstant('GiftCodeExpiryPeriod'));
                if($membership->walletBal>$model->amount){
                //if(ArrayHelper::isIn($model->recipientEmail,$memberDetails->getValidGcodesEmail())){
                    $model->retrieveBy = $memberDetails->getMemberPartsByEmail($model->recipientEmail);
                    $model->recordBy=Yii::$app->user->id;
                    $model->recordDate= date('Y-m-d H:i:s');
                    $model->save();// && sendgcemail();
                    $memberDetails->addWalletEntry($membership->memberId,'Wallet',$model->dateGen, 5,$model->code ,-1,$model->amount);
                    //$model->recipientEmail= Yii::$app->userdetails->getUserParts($membership->memberId,2);
                    $model->sendEmail($membership->memberId,$model->id);
                    $session->setFlash('success', 'Gift Code '.$model->code.' successfully generated');
                    if(!empty($model->recipientEmail)){
                        sleep(10);
                        $model->sendGcRecipientEmail($membership->memberId,$model->id);
                        $session->addFlash('success','Email sent to '.$model->recipientEmail);
                    }        
                    return $this->redirect(['/dashboard/wallet/index']);

                }else{
                    $session->setFlash('error','Gift Code NOT generated. Please check the Wallet balance');
                }
            }catch(\yii\base\Exception $ex){
                $session->setFlash('error','Unable to generate Gift Code to DB'.$ex->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'membership' => $membership,
            'memberDetails' => $memberDetails,
            'myarr' => $myarr,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);
    }

    /**
     * Creates a new Tblgcodes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionGenerate()
    {
        $session=Yii::$app->session;
        $useful = Yii::$app->useful;
        $memberDetails = Yii::$app->memberdetails;
        $membership= new Membership();
        $model = new Tblgcodes();
        
        
        if ($model->load(Yii::$app->request->post())&&$model->validate()  ) {
            $model->amount = $memberDetails->getPackConfigItemsById($model->packconfigId);
            if($model->amount > $membership->walletBal){
                $model->memberGen = $membership->memberId;
                $model->dateGen = date('Y-m-s H:i:s');
                $model->code = $memberDetails->getPackConfigItemsById($model->packconfigId,2)/*($model->amount=25?'GCG':'GCD')*/. time();
                $model->expiryDate = $useful->addDateInterval(addDateInterval,$memberDetails->getAppConstant('GiftCodeExpiryPeriod'));
                $model->recordDate=date('Y-m-s H:i:s');
                $model->recordBy = Yii::$app->user->id;
                $model->save();
                $model->sendEmail($model->memberGen,$model->id);
                addWalletEntry($model->memberGen,'GiftCodes',$model->dateGen, 5/*trxMethod*/,$model->code,1 /*trxDir*/,$model->amount);
            }else{// Not enough fundsin wallet
                $session->setFlash('warning','Sorry, your wallet does not have enough funds to create this Gift Code! '
                        . '<br> Either transfer earnings from the commissions, or  request another member to transfer to you before attampting again.');
            }
            return $this->redirect(['/dashboard/wallet/index']);
            
        }

        return $this->render('generate', [
            'model' => $model,
        ]);
    }
    
    /**
     * Updates an existing Tblgcodes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        $memberDetails = Yii::$app->memberdetails;
        $membership = new Membership();
        $model = $this->findModel($id);
        $myarr = $memberDetails->getPackConfigOptions(2);//no subscriptionth
        $model->packconfigId = $memberDetails->getPackageFromPrefix(substr($model->code,0,3));

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(!empty($model->recipientEmail)){
                        //sleep(10);
                        $model->sendGcRecipientEmail($membership->memberId,$model->id);
                        $session->addFlash('success','Email sent to '.$model->recipientEmail);
            }
            return $this->redirect(['create']);
        }

        return $this->render('update', [
            'model' => $model,
            'myarr' => $myarr,
        ]);
    }

    /**
     * Deletes an existing Tblgcodes model.
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
     * Finds the Tblgcodes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblgcodes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblgcodes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function getAllPayOptions()
    {
        $myarr=array();
        $model= Packconfig::find()->with('pack','trxType0')->asArray()->all();
        foreach($model as $i=>$item){
           $myarr[$i]['amt'] =$item['amount'];
           $myarr[$i]['Item'] = $item['trxType0.ptypeName'].' '.$item['pack.packName'];
        }
        return $myarr;
    }
}
