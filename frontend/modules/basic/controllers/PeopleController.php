<?php

namespace frontend\modules\basic\controllers;

use Yii;
use frontend\modules\basic\models\People;
use frontend\modules\basic\models\PeopleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Json;
use frontend\modules\basic\models\Dialcodes;
use frontend\modules\basic\models\Cities;
use frontend\modules\basic\models\CFlags;

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
                'only' => ['create', 'index', 'list-cities','update','view','upd-people-id','extract-dialcode', 'extract-flag'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'index', 'list-cities','update','view','upd-people-id','extract-dialcode', 'extract-flag'],
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
        $citylist=$this->actionListCities($model->nationality);
        $session = Yii::$app->session;
        $backlink = !is_null(Yii::$app->session['backlink'])?Yii::$app->session['backlink']:'';
        $searchModel = new PeopleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post()) ) {
            try{
                $model->recordBy= Yii::$app->user->id;
                $model->recordDate = date('Y-m-d H:i:s');
                $model->save();
                
                $peopleId = $model->id;//Yii::$app->db->getLastInsertID();
                $this->updPeopleId($peopleId);//in user table
                //$model = new People();
                $session->setFlash('success','Personal Details for '.$model->firstName.' '. $model->surname.' successfully saved.');
                if(!Yii::$app->memberdetails->isRegistered($peopleId)){
                    return $this->redirect(['/payments/inpayments/packregistration','member'=>$peopleId]);
                }
                elseif (!is_null($backlink) || (!strcmp('',$backlink))/* there is a backlink */){
                    Yii::$app->session['backlink']='';
                      return $this->redirect([$backlink]);

                }
            } catch (\yii\db\Exception $e){
                $session->setFlash('error','Error occured: '.$e->getMessage());
            }
            
        } 
            return $this->render('create', [
                'model' => $model,
                'backlink'=>$backlink,
                //'citylist'=>$citylist,
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
    public function updPeopleId($peopleid)
    {
        $db = Yii::$app->db;
        $db->createCommand("UPDATE user SET peopleId=".$peopleid." WHERE id=".Yii::$app->user->id)->execute();                  
    }
    public function actionListCities($id)
    {
        $cities = Cities::find()->where(['country'=>$id])->orderBy('city')->asArray()->all();
        $mylist='<option>--City/ Town--</option>';
        
        foreach ($cities as $i=>$cty ){
            $mylist.="<option value='".$cty['id']."'>".$cty['city']."</option>";
        }
        /*$mylist=array(array());
        if(!empty($cities)){
            foreach($cities as $i=>$cty ){
                $mylist [$i]['id']= $cty['id'];
                $mylist [$i]['city']= $cty['city'];
            }
        }*/
        if(Yii::$app->request->isAjax){
            //echo Json::encode($cities,true);
            echo $mylist;
        }else{
            //return $cities;
            return $mylist;
        }
    }
    
    public function actionExtractDialcode($id)
    {
        $code =  Dialcodes::find()->where(['c_id'=>$id])->one();
        echo Json::encode('+'.$code['countryCode']);
    }
    public function actionExtractFlag($id)
    {
        $flag =  CFlags::find()->where(['c_id'=>$id])->one();
        echo Json::encode('<img src="images/flags/'.$flag['countryFlag'].'" height = "0.4rem" class="img-responsive">');
    }
}
