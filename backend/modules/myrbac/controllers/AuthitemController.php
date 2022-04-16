<?php

namespace backend\modules\myrbac\controllers;

use Yii;
use backend\modules\myrbac\models\AuthItem;
use backend\modules\myrbac\models\AuthItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthItemController implements the CRUD actions for AuthItem model.
 */
class AuthitemController extends Controller
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
        ];
    }

    /**
     * Lists all AuthItem models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AuthItem model.
     * @param string $id
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
     * Creates a new AuthItem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session=Yii::$app->session;
        $model = new AuthItem();
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) ) {
            try{
                $model->save();
                $session->setFlash('success','\''.$model->permission.'\' successfully created as a Permission');
                
            }catch(Exception $e){
                $session->setFlash('error','\''.$model->permission.'\' NOT created as a Permission: '. $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreatePermission()
    {
        $session=Yii::$app->session;
        $model = new AuthItem();
        $model->type=2;
        $model->itemname='Permission';
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->searchPermissions($model->type,Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) ) {
            try{
                $model->save();
                $session->setFlash('success','\''.$model->permission.'\' successfully created as a Permission');
                
            }catch(Exception $e){
                $session->setFlash('error','\''.$model->permission.'\' NOT created as a Permission: '. $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'itemname' => $model->itemname,
        ]);
    }
    
    public function actionCreateRole()
    {
        $session=Yii::$app->session;
        $model = new AuthItem();
        $model->type=1;
        $model->itemname='Role';
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->searchPermissions($model->type,Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) ) {
            try{
                $model->save();
                $session->setFlash('success','\''.$model->permission.'\' successfully created as a Permission');
                
            }catch(Exception $e){
                $session->setFlash('error','\''.$model->permission.'\' NOT created as a Permission: '. $e->getMessage());
            }
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'itemname' => $model->itemname,
        ]);
    }
    
    /**
     * Updates an existing AuthItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing AuthItem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AuthItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AuthItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AuthItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
