<?php

namespace backend\modules\myrbac\controllers;

use Yii;
use yii\web\Controller;
use backend\modules\myrbac\models\Auth;
use backend\modules\myrbac\models\AuthItem;
use backend\modules\myrbac\models\AuthItemSearch;

class AuthconsoleController extends Controller
{
    public function actionAuthassignment()
    {
        
        return $this->render('authassignment');
    }

    public function actionAuthitem()
    {
        return $this->render('authitem');
    }
    
    public function actionAssignpermission()
    {
        $model = new Auth();
        $model->typeTitle = 'Permission';
        if($model->load(Yii::$app->request->post() && $model->validate())){
            try{
            $auth = Yii::$app->authManager;
            // add "createPost" permission
            $createPost = $auth->createPermission($model->permissionOrRole);
            $createPost->description = $model->description;
            $auth->add($createPost);
            }catch(Exception $e){
                
            }
        }
        return $this->render('assignpermission');
    }
    
    public function actionAssignrole()
    {
        $session = Yii::$app->session;
        $model = new \backend\modules\myrbac\models\Auth();
        $model->typeTitle = 'Role';
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $auth = Yii::$app->authManager;
            // add "createPost" permission
                $createPost = $auth->createRole($model->permissionOrRole);
                $createPost->description = $model->description;
                $auth->add($createPost);
            }
        }

        return $this->render('permissionorrole', [
            'model' => $model,
        ]);
    }
    
    public function actionPermissionorrole()
    {
        $session = \Yii::$app->session;
        $model = new \backend\modules\myrbac\models\Auth();
        $model->typeTitle = 'Permission';
        
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->searchPermissions(2,Yii::$app->request->queryParams);
        if ($model->load(Yii::$app->request->post())) {
            try{
                $model->validate(); 
                    $auth = Yii::$app->authManager;
                // add "createPost" permission
                    $createPost = $auth->createPermission($model->permissionOrRole);
                    $createPost->description = $model->description;
                    $auth->add($createPost);
                    $session->setFlash('success','\''.$model->permissionOrRole.'\' successfully created as a Permission');
                
            }catch(Exception $e){
                $session->setFlash('error','\''.$model->permissionOrRole.'\' NOT created as a Permission: '. $e->getMessage());
            }
        }

        return $this->render('permissionorrole', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAssignarole()
    {
        $session = \Yii::$app->session;
        $model = new Auth();
        $model->titleType='Role';
        $searchModel = new AuthItemSearch();
        $dataProvider = $searchModel->searchPermissions(1,Yii::$app->request->queryParams);

        if ($model->load(Yii::$app->request->post())) {
            try {
                ($model->validate()) ;
                $auth = Yii::$app->authManager;
            // add "createPost" permission
                $createPost = $auth->createRole($model->permissionOrRole);
                $createPost->description = $model->description;
                $auth->add($createPost);
                $session->setFlash('success','\''.$model->permissionOrRole.'\' successfully created as a Role');
            }catch(Exception $ex){
                $session->setFlash('error','\''.$model->permissionOrRole.'\' NOT successfully created as a Role'.$ex->getMessage());
            }
        }

        return $this->render('assignarole', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdate($id,$titleType){
        $session = \Yii::$app->session;
        $model= $this->findModel($id);
        $model->titleType = $titleType;
        if ($model->load(Yii::$app->request->post()) ){
            try{ 
            $model->save();
             $session->setFlash('success','successfully updated');
            }catch(Exception $ex){
                $session->setFlash('error','Update NOT successful');
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
    
    public function actionAuthhierarchy()
    {
        $session = \Yii::$app->session;
        $auth = \Yii::$app->authManager;
        $model = new \backend\modules\myrbac\models\AuthHierarchy();
        
        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                
                $parentRole = $auth->getRole($model->parent );
                $childRole = $auth->getRole($model->child );
                $auth->addChild($parentRole, $childRole);
                $session->setFlash('success',$parentRole.' successfully added as Parent to '. $childRole);
            }
        }

        return $this->render('authhierarchy', [
            'model' => $model,
        ]);
    }


    protected function findModel($id)
    {
        if (($model = AuthItem::find(['name'=>$id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested name does not exist.'));
    }
    
    
    public function actionAuthitemchild()
    {
        return $this->render('authitemchild');
    }

    public function actionAuthrule()
    {
        return $this->render('authrule');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

}
