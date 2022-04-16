<?php

namespace app\modules\payments\controllers;

use Yii;
use backend\modules\payments\models\Tblgcodes;
use backend\modules\payments\models\TblgcodesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * GcodesController implements the CRUD actions for Tblgcodes model.
 */
class GcodesController extends Controller
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
                'only' => ['create','delete','index','update','view', 'cancelexpired'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create','delete','index','update','view','cancelexpired'],
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
        //$session = Yii::$app->session;
        
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
        $model = new Tblgcodes();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCancelexpired()
    {
            $session = Yii::$app->session;
            $memberDetails = Yii::$app->memberdetails;
            $theDate = date('Y-m-d H:i:s');
            $memberDetails->reverseGCodes($theDate);
            $session->setFlash('success', 'All expired Gift Codes have been reversed!');
            $this->redirect(['index']);
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
}
