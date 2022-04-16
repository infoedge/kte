<?php

namespace backend\modules\basic\controllers;

use Yii;
use backend\modules\basic\models\People;
use backend\modules\basic\models\PeopleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PeopleController implements the CRUD actions for People model.
 */
class PeopleController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all People models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeopleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single People model.
     * @param integer $id
     * @param integer $people_id
     * @param integer $people_IdentityType
     * @return mixed
     */
    public function actionView($id, $people_id, $people_IdentityType)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $people_id, $people_IdentityType),
        ]);
    }

    /**
     * Creates a new People model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new People();
        Yii::$app->peopledefaults->setValues($model);
        $session = Yii::$app->session;
        $backlink = !is_null(Yii::$app->session['backlink'])?Yii::$app->session['backlink']:'';
        $searchModel = new PeopleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post()) ) {
            
            $model->recordBy= Yii::$app->user->id;
            $model->recordDate = date('Y-m-d H:i:s');
            $model->save();
            $session->setFlash('success','Personal Details for '.$model->firstName.' '. $model->surname.' successfully saved.');
            //return $this->redirect(['view', 'id' => $model->id, 'people_id' => $model->people_id, 'people_IdentityType' => $model->people_IdentityType]);
            $model = new People();
            if (!is_null($backlink) || (!strcmp('',$backlink))/* there is a backlink */){
                Yii::$app->session['backlink']='';
                  return $this->redirect([$backlink]);
                  
            }
        } 
            return $this->render('create', [
                'model' => $model,
                'backlink'=>$backlink,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        
    }

    /**
     * Updates an existing People model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $people_id
     * @param integer $people_IdentityType
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $session = Yii::$app->session;
        $backlink = !is_null(Yii::$app->session['backlink'])?Yii::$app->session['backlink']:'';
        
        if ($model->load(Yii::$app->request->post())&& Yii::$app->request->post('btn')==1  ) {
            
            $model->save();
            return $this->redirect(['create']);
        }elseif(Yii::$app->request->post('btn')==2){
            return $this->redirect(['contacts/add','personId'=>$id]);
        }
        //else {
            return $this->render('update', [
                'model' => $model,
                'backlink'=>$backlink,
                'id' => $id,
            ]);
       // }
    }

    /**
     * Deletes an existing People model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $people_id
     * @param integer $people_IdentityType
     * @return mixed
     */
    public function actionDelete($id, $people_id, $people_IdentityType)
    {
        $this->findModel($id, $people_id, $people_IdentityType)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the People model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $people_id
     * @param integer $people_IdentityType
     * @return People the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = People::findOne($id))!== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
