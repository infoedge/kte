<?php

namespace app\modules\payments\controllers;

use Yii;
use backend\modules\payments\models\Referralbonusconfig;
use backend\modules\payments\models\ReferralbonusconfigSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ReferralbonusconfigController implements the CRUD actions for Referralbonusconfig model.
 */
class ReferralbonusconfigController extends Controller
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
                'only' => ['create','delete','index','update','view'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create','delete','index','update','view'],
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
     * Lists all Referralbonusconfig models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReferralbonusconfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Referralbonusconfig model.
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
     * Creates a new Referralbonusconfig model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $useful = Yii::$app->useful;
        $model = new Referralbonusconfig();
        $searchModel = new ReferralbonusconfigSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        if ($model->load(Yii::$app->request->post()) ) {
            $model->recordBy = Yii::$app->user->id;
            $model->recordDate = date('Y-m-d H:i:s');
            $model->configCntrl = $useful->x_digit($model->trxType,2)
                    .$useful->x_digit($model->sPackage,2)
                    .$useful->x_digit($model->sRank,2)
                    .$useful->x_digit($model->mPackage,2)
                    .$useful->x_digit($model->level,4);
            $model->save();
            $model = new Referralbonusconfig();
            //return $this->redirect(['create');
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Referralbonusconfig model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {
            $useful = Yii::$app->useful;
            $model->changedBy = Yii::$app->user->id;
            $model->changedDate = date('Y-m-d H:i:s');
            $model->configCntrl = $useful->x_digit($model->trxType,2)
                    .$useful->x_digit($model->sPackage,2)
                    .$useful->x_digit($model->sRank,2)
                    .$useful->x_digit($model->mPackage,2)
                    .$useful->x_digit($model->level,4);
            $model->save();
            return $this->redirect(['create']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Referralbonusconfig model.
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
     * Finds the Referralbonusconfig model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Referralbonusconfig the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Referralbonusconfig::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
