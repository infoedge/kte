<?php

namespace app\modules\payments\controllers;

use Yii;
use backend\modules\payments\models\Tblwithdrawal;
use backend\modules\payments\models\TblwithdrawalSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * WithdrawalController implements the CRUD actions for Tblwithdrawal model.
 */
class WithdrawalController extends Controller
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
                'only' => ['create','delete','index','update','view','confirmpay','pendinglist'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create','delete','index','update','view','confirmpay','pendinglist'],
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
        $searchModel = new TblwithdrawalSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Tblwithdrawal models.
     * @return mixed
     */
    public function actionPendinglist()
    {
        $searchModel = new TblwithdrawalSearch();
        $dataProvider = $searchModel->searchPending(Yii::$app->request->queryParams);

        return $this->render('pendinglist', [
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
    public function actionCreate()
    {
        $model = new Tblwithdrawal();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
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
     * Updates an existing Tblwithdrawal model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionConfirmpay($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->approvedBy = Yii::$app->user->id;
            $model->approvedDate = date('Y-m-d H:i:s');
           ($model->status==2)?
                $session->setFlash('success', 'Payment  successfully marked as COMPLETED'):
            (($model->status==3)/* Cancelled */?
                $session->setFlash('warning', 'Payment marked as CANCELLED'):
                    ''
                        );
            
            
            return $this->redirect(['pendinglist']);
        }

        return $this->render('confirm', [
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
