<?php

namespace app\modules\reports\controllers;

use Yii;
use backend\modules\reports\models\Inpayments;
use backend\modules\reports\models\InpaymentsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

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
                'only' => ['index','showdaily','view','create','delete','update'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','showdaily'],
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
    
    public function actionShowdaily()
    {
        $model= new Inpayments();
        $count = $model->getShowDailyDayCount();
        $model->getOverallTotals();
        $dataProvider = new \yii\data\SqlDataProvider([
            'sql'=> 'SELECT Date(pdate) AS JoinDate, 
                    SUM(CASE WHEN package=1 AND ptype=1 THEN 1 ELSE 0 END) as GoldRegCount, 
                    SUM(CASE WHEN package=1 AND ptype=1 THEN amount ELSE 0 End) as GoldRegAmt,
                    SUM(CASE WHEN package=1 AND ptype=2 THEN 1 ELSE 0 END) as GoldSubsCount, 
                    SUM(CASE WHEN package=1 AND ptype=2 THEN amount ELSE 0 End) as GoldSubsAmt,
                    SUM(CASE WHEN package=2 AND ptype=1 THEN 1 ELSE 0 END) as DiamondRegCount, 
                    SUM(CASE WHEN package=2 AND ptype=1 THEN amount ELSE 0 End) as DiamondRegAmt,
                    SUM(CASE WHEN package=2 AND ptype=3 THEN 1 ELSE 0 END) as DiamondUpgCount, 
                    SUM(CASE WHEN package=2 AND ptype=3 THEN amount ELSE 0 End) as DiamondUpgAmt,
                    SUM(CASE WHEN package=2 AND ptype=2 THEN 1 ELSE 0 END) as DiamondSubsCount, 
                    SUM(CASE WHEN package=2 AND ptype=2 THEN amount ELSE 0 End) as DiamondSubsAmt,
                    SUM( 1 ) as TotCount, 
                    SUM( amount) as TotAmt
                    from inpayments where 1
                    GROUP BY JoinDate
                    order BY joinDate DESC',
            'totalCount'=> $count,
                    ]);

        

        return $this->render('showdaily', [
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
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

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
