<?php

namespace frontend\modules\basic\controllers;

use Yii;
use backend\modules\basic\models\Contacts;
use backend\modules\basic\models\ContactsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\Contacttypes;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * ContactsController implements the CRUD actions for Contacts model.
 */
class ContactsController extends Controller
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
        ];
    }

    /**
     * Lists all Contacts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContactsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contacts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $contactTypesCount = Contacttypes::find()->count();
        $cotactTypeIds = $this->getContactTypeIds();
        $contacts[] = (new Contacts());
        
        for($i=1;$i<$contactTypesCount;$i++){
            $contacts[] = (new Contacts());
            
        }
        if (Model::loadMultiple($contacts,Yii::$app->request->post())&& \yii\base\Model::validateMultiple($contacts) ) {
            
            //return $this->redirect(['view', 'id' => $model->id]);
            
        } //else {
            return $this->render('create', [
                'contacts' => $contacts,
                'contactTypesCount' => $contactTypesCount,
                'cotactTypeIds' =>  $cotactTypeIds,
            ]);
       // }
    }

    /**
     * Creates a new Contacts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionAdd($personId)
    {
        $session=Yii::$app->session;
        $contactTypesCount = Contacttypes::find()->count();
        $contactTypeIds = $this->getContactTypeIds();
        $contacts=$this->getContacts($personId);
        if (Model::loadMultiple($contacts,Yii::$app->request->post()) ) {
            
            //return $this->redirect(['view', 'id' => $model->id]);
            foreach( $contacts as $i =>$model) {
                
                $this->setBasicAttributes($model);
                if($model->validate()){
                    
                    $model->save();
                }else{
                    $session->addFlash('error',"Unable to save record $i");
                }
            }
            $session->setFlash('success','contacts for '.$contacts[0]->person->fullName.' successfully saved');
            return $this->redirect(['people/create']);
        } //else {
            return $this->render('add', [
                'contacts' => $contacts,
                'contactTypesCount' => $contactTypesCount,
                'contactTypeIds' =>  $contactTypeIds,
            ]);
       // }
    }
    
    /**
     * Updates an existing Contacts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Contacts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Contacts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contacts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contacts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function getContactTypeIds(){
        $model= Contacttypes::find()->asArray()->all();
        return array_values(ArrayHelper::getColumn($model, 'id'));
    }
    public function getContacts($personId){
        $contactTypesCnt = Contacttypes::find()->count();
        $contactTypeIds = $this->getContactTypeIds();
        $contacts = Contacts::find()->where(['PersonId'=>$personId])->all();
        $contactsCnt = Contacts::find()->where(['PersonId'=>$personId])->count();
        for($i=$contactsCnt;$i<$contactTypesCnt;$i++){
            $contacts[] = (new Contacts());
            $contacts[$i]->PersonId = $personId;
            $contacts[$i]->ContactType = $contactTypeIds[$i];
        }
        return $contacts;
    }
    
    /**
     * 
     * @param type $model
     */
    protected function setBasicAttributes(&$model){
                $model->recordBy = Yii::$app->user->id;
                $model->recordDate = date('Y-m-d H:i:s');
                if(!$model->isNewRecord && $model->getDirtyAttributes(['ContactsValue'])){
                    $model->changedBy = Yii::$app->user->id;
                    $model->changedDate = date('Y-m-d H:i:s');
                }
    }
}
