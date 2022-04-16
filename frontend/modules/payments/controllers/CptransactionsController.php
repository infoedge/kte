<?php

namespace app\modules\payments\controllers;

use Yii;
use frontend\modules\payments\models\Cptransactions;
use frontend\modules\payments\models\CptransactionsSearch;
use frontend\modules\payments\models\Inpayments;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\JsonParser;
use yii\helpers\Json;
use CoinpaymentsAPI;

/**
 * CptransactionsController implements the CRUD actions for Cptransactions model.
 */
class CptransactionsController extends Controller {
    public $layout = 'main';
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'delete', 'index', 'update', 'view', 'startpay', 'paystatus', 'basic-account-info'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'delete', 'index', 'update', 'view', 'startpay', 'paystatus', 'basic-account-info'],
                        'roles' => ['@'],
                    ],
                ],
            /* 'denyCallback' => function ($rule, $action) {
              throw new \Exception('You are not allowed to access this page');
              } */
            ],
        ];
    }

    /**
     * Lists all Cptransactions models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new CptransactionsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cptransactions model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Cptransactions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Cptransactions();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            //return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new Cptransactions model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionStartpay() {
        $session = Yii::$app->session;
        $memberDetails = Yii::$app->memberdetails;
        $memberId = $session['memberId'];
        $trxId = $session['ptype'];
        $model =  Cptransactions::find()->where(['memberId'=>$memberId, 'trxId'=>$trxId])->one();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
          $model->save();
          
          $memberDetails->updInpayments($model);
          $this->redirect(['inpayments/awaitapproval']);
          
        }
        return $this->render('startpay', [
                    'model' => $model,
                    'result' => empty($result) ? '' : $result,
        ]);
    }

    public function actionBasicAccountInfo() {
        // Create a new API wrapper instance and call to the get basic account information command.
        try {
            //new CoinpaymentsAPI($private_key, $public_key, 'json');
            $cps_api = new CoinpaymentsAPI(Yii::$app->params['cpPrivKey'], Yii::$app->params['cpPublKey'], 'json');
            $information = $cps_api->GetBasicInfo();
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
            exit();
        }

        // Check for success of API call
        if ($information['error'] == 'ok') {
            // Prepare start of sample HTML output
            $output = '<table><tbody><tr><td>Username</td><td>Merchant ID</td><td>Email</td><td>Public Name</td></tr>';
            $output .= '<tr><td>' . $information['result']['username'] . '</td><td>' . $information['result']['merchant_id'] . '</td><td>' . $information['result']['email'] . '</td><td>' . $information['result']['public_name'] . '</td></tr>';
            // Close the sample output HTML and echo it onto the page
            $output .= '</tbody></table>';
            //echo $output;
        } else {
            // Throw an error if both API calls were not successful
            $output = 'There was an error returned by the API call: ' . $balances['error'] . '<br>Rates API call status: ' . $rates['error'];
        }

        return $this->render('basicaccinfo', [
                    'cps_api' => $cps_api,
                    'output' => $output,
                    'information' => $information,
        ]);
    }

    /**
     * Updates an existing Cptransactions model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cptransactions model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cptransactions model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cptransactions the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Cptransactions::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionPaystatus($data) {
        $result = Json::decode($data);
        return $this->render('paystatus', [
                    //'model' => $model,
                    'result' => empty($result) ? '' : $result,
        ]);
    }
    public function updInpayments($myrec)
    {
        $session=Yii::$app->session;
        $model=new Inpayments();
            /*$memberId = $session['memberId'];
            $trxId = $session['ptype'];
            $amount = $session['amount'];
            $package = $session['package'];*/
            $model->cpRecExists = 1;
            $model->member=$myrec->memberId;
            $model->pMethod=4;
            $model->package=$myrec->packId;
            $model->ptype=$myrec->trxId;
            $model->amount=$myrec->amount;
            $model->pdate=date('Y-m-d H:i:s');
            $model->transactionNo = $myrec->bc_trx_id;
            $model->recordBy=Yii::$app->user->id;
            $model->recordDate=date('Y-m-d H:i:s');
            $model->save();
        
    }
}
