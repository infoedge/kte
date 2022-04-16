<?php

namespace app\modules\training\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use frontend\modules\training\models\Videolist;

class SocialmediaController extends \yii\web\Controller
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
                'only' => ['index','soc001','build-link'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','soc001','build-link'],
                        'roles' => ['Gold','Diamond'],
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
        $video= Videolist::find()->with('videoType0')->where(['vTopic'=>7])->one();
        
        if ($model->load(Yii::$app->request->post())) {
            $video= Videolist::find()->with('videoType0')->where(['vid'=>$model->vid])->one();
        }
        //$model=$video;
        $model->thelink=$video->videoType0->urlPrefix.$video->vid;
        $model->vName = $video->vName;
        $model->vDesc = $video->vDesc;
        $videoCount = Videolist::find()->where(['vTopic' => 7])->count();
        return $this->render('index',[
            'model'=> $model,
            'videoCount' => $videoCount,
        ]);
    }

    public function actionSoc001()
    {
        return $this->render('soc001');
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
