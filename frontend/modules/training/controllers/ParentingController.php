<?php

namespace app\modules\training\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\modules\training\models\Videolist;

class ParentingController extends \yii\web\Controller
{
    public $layout = '@app/views/layouts/dashboard';
    
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
                'only' => ['index','par001','par002','par003','par004','par005', 'par006', 'par007', 'par008', 'par009','rel001','build-link'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','par001','par002','par003','par004','par005', 'par006', 'par007', 'par008', 'par009','rel001','build-link'],
                        'roles' => ['Diamond'],
                    ],
                    
                ],
                /*'denyCallback' => function ($rule, $action) {
                            throw new \Exception('You are not allowed to access this page');
                    }*/
            ],
        ];
    }
    public function actionIndex()
    {
        $model= new Videolist();
        //$video= Videolist::find()->with('videoType0')->where(['vid'=>'7QLJnqAChHU'])->one();
        $video= Videolist::find()->with('videoType0')->where(['vTopic'=>8])->one();
        
        if ($model->load(Yii::$app->request->post())) {
            $video= Videolist::find()->with('videoType0')->where(['vid'=>$model->vid])->one();
        }
        //$model=$video;
        $model->thelink=$video->videoType0->urlPrefix.$video->vid;
        $model->vName = $video->vName;
        $model->vDesc = $video->vDesc;
        $videoCount = Videolist::find()->where(['vTopic' => 8])->count();
        return $this->render('index',[
            'model'=> $model,
            'videoCount' => $videoCount,
        ]);
    }

    public function actionPar001()
    {
        return $this->render('par001');
    }

    public function actionPar002()
    {
        return $this->render('par002');
    }

    public function actionPar003()
    {
        return $this->render('par003');
    }

    public function actionPar004()
    {
        return $this->render('par004');
    }

    public function actionPar005()
    {
        return $this->render('par005');
    }

    public function actionPar006()
    {
        return $this->render('par006');
    }

    public function actionPar007()
    {
        return $this->render('par007');
    }

    public function actionPar008()
    {
        return $this->render('par008');
    }

    public function actionPar009()
    {
        return $this->render('par009');
    }
    
    public function actionRel001()
    {
        return $this->render('rel001');
    }
    public function actionBuildLink($id)
    {
        $result= array();
        $model= Videolist::find()->where(['vid'=>$id])->one();
        
        if(!empty($model)){
            $result['thelink'] = $model->videoType0->urlPrefix.$model->vid;
            $result['vName'] = $model->vName;
        }
        echo \yii\helpers\Json::encode($result);
    }

}
