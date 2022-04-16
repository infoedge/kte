<?php

namespace app\modules\payments\controllers;

use Yii;
use frontend\modules\payments\models\Tblwithdrawal;
use frontend\modules\payments\models\TblwithdrawalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\modules\dashboard\models\Membership;

/**
 * WithdrawalController implements the CRUD actions for Tblwithdrawal model.
 */
class WithdrawalController extends Controller
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
                'only' => ['index','create','delete','update','view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create','delete','update','view'],
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
     * Lists all Tblwithdrawal models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$session = Yii::$app->session;
        //$memberDetails = Yii::$app->memberdetails;
        //$fmt = Yii::$app->formatter;
        $membership = new Membership();
        $member = $membership->memberId;
        $searchModel = new TblwithdrawalSearch();
        $dataProvider = $searchModel->searchByMember( $member,Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tblwithdrawal model.
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
     * Creates a new Tblwithdrawal model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionWithdraw()
    {
        $session = Yii::$app->session;
        $memberDetails = Yii::$app->memberdetails;
        $fmt = Yii::$app->formatter;
        $model = new Tblwithdrawal();
        $membership = new Membership();
        $model->member = $membership->memberId;
        if ($model->load(Yii::$app->request->post())&& $model->validate() ) {
            if($model->amount<=($membership->walletBal*(1+($memberDetails->getAppConstant('commissionOnWithdrawal')/100)))){
            $mytime = time();
            //$model->member = $membership->memberId;
            $model->recordBy = Yii::$app->user->id;
            $model->withdrawalCode = 'WDL'.$mytime;
            $commissionCode = 'CMS'.$mytime;
            $model->recordDate = date('Y-m-d H:i:s');
            $model->requestBy= Yii::$app->user->id;
            $model->requestDate =  date('Y-m-d H:i:s');
            $model->save();
            //deduct from wallet

            $memberDetails->addWalletEntry($model->member,'Wallet',$model->requestDate, 10/*Funds Withdrawn*/,$model->withdrawalCode ,-1,$model->amount);
            //deduct withdrwal commission
            $trxCommission = $model->amount*($memberDetails->getAppConstant('commissionOnWithdrawal')/100);
            $memberDetails->addWalletEntry($model->member,'Wallet',$model->requestDate, 8/*Commission*/,$commissionCode ,-1,$trxCommission);
            ///
            $session->setFlash('success', 'Request successfully lodged');
            return $this->redirect(['/dashboard/wallet/index']);
            }else{// 
                $maxWithdrawAmount = $membership->walletBal/(1+($memberDetails->getAppConstant('commissionOnWithdrawal')/100));
                $session->setFlash('warning', 'The maximum you can withdraw is $'.$fmt->asDecimal($maxWithdrawAmount,2).'. Please change the amount');
        }
        }

        return $this->render('withdraw', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tblwithdrawal model.
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
     * Deletes an existing Tblwithdrawal model.
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
     * Finds the Tblwithdrawal model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tblwithdrawal the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tblwithdrawal::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
