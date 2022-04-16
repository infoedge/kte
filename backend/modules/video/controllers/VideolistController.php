<?php

namespace app\modules\video\controllers;

use Yii;
use backend\modules\video\models\Videolist;
use backend\modules\video\models\VideolistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * VideolistController implements the CRUD actions for Videolist model.
 */
class VideolistController extends Controller
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
                'only' => ['index','create','delete','view','update','errorpage','next-serial'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','create','delete','view','update','next-serial'],
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
     * Lists all Videolist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VideolistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Videolist model.
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
     * Creates a new Videolist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $session = Yii::$app->session;
        $model = new Videolist();
        $searchModel = new VideolistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session->setFlash('success','Video \''.$model->vName.'\' successfully saved');
            $model = new Videolist();
            //return $this->redirect(['default index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Videolist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $session = Yii::$app->session;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $session->setFlash('success','Video \''.$model->vName.'\' successfully updated');
            return $this->redirect(['create']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionMove($id)
    {
        $session = Yii::$app->session;
        //$reorder = Yii::$app->ordering;
        $model = $this->findModel($id);
        $modelsCnt = Videolist::find()->where(['vTopic'=>$model->vTopic])->count();

        if ($model->load(Yii::$app->request->post()) ) {
            if(!empty($model->getOldAttribute('order')) && ($model->order<= $modelsCnt)){
            //$reorder->movNumber($model->getOldAttribute('order'),$model->order,$model->vTopic);
            $this->movNum($id, $model->order);
            //$model->save();
            $session->setFlash('success','Video \''.$model->vName.'\' successfully re-ordered to # '.$model->order);
            }elseif($model->order> $modelsCnt){
                $session->setFlash('warning','The maximum # allowed is '.$modelsCnt);
            }elseif(empty($model->getOldAttribute('order'))){
                $session->setFlash('warning','There was no change of order #');
            }else {// no change in order
                $session->setFlash('warning','Order for Video \''.$model->vName.'\' unchanged');
            }
            return $this->redirect(['create']);
        }

        return $this->render('move', [
            'model' => $model,
            'modelsCnt' => $modelsCnt,
        ]);
    }
    /**
     * Deletes an existing Videolist model.
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
     * Finds the Videolist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Videolist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Videolist::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
    public function actionNextSerial($id)
    {
        $cnt= (Videolist::find()->where(['vTopic'=>$id])->count()) + 1;
        $result= array('order'=>$cnt);
        
        echo \yii\helpers\Json::encode($result);
    }
    
    public function movNum($curId/*Current Id*/,$toNum/*new Number*/)
    {
        $curmodel = Videolist::findOne($curId);
        $fromNum = $curmodel->order;
        $grpNum = $curmodel->vTopic;
        $this->remGap($fromNum, $grpNum);
        $this->insGap($toNum , $grpNum);
        $curmodel->order=$toNum; 
        $curmodel->save();
    }
    protected function remGap($fromNum, $grpNum)
    {
        $models= Videolist::find()->where(['>','order',$fromNum])->andWhere(['vTopic'=>$grpNum])->all();
        foreach($models as $model){
            $model->order= $model->order-1;
            $model->save();
        }
    }
    
    protected function insGap($toNum, $grpNum)
    {
        $models= Videolist::find()->where(['>=','order',$toNum])->andWhere(['vTopic'=>$grpNum])->all();
        foreach($models as $model){
            $model->order= $model->order+1;
            $model->save();
        }
    }
}
