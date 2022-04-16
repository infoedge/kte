<?php

namespace app\modules\training\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


use frontend\modules\training\models\Videolist;

class MaxpotentialController extends \yii\web\Controller
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
                'only' => ['index','max001','max002','max003','max004','max005', 'max006', 'max007', 'max008', 'max009','max010','max011','max012','max013','build-link'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['errorpage'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','max001','max002','max003','max004','max005', 'max006', 'max007', 'max008', 'max009','max010','max011','max012','max013','build-link'],
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
        $video= Videolist::find()->with('videoType0')->where(['vTopic'=>4])->one();
        
        if ($model->load(Yii::$app->request->post())) {
            $video= Videolist::find()->with('videoType0')->where(['vid'=>$model->vid])->one();
        }
        //$model=$video;
        $model->thelink=$video->videoType0->urlPrefix.$video->vid;
        $model->vName = $video->vName;
        $model->vDesc = $video->vDesc;
        $videoCount = Videolist::find()->where(['vTopic' => 4])->count();
        return $this->render('index',[
            'model'=> $model,
            'videoCount' => $videoCount,
        ]);
    }

    public function actionMax001()
    {
        return $this->render('max001');
    }

    public function actionMax002()
    {
        return $this->render('max002');
    }

    public function actionMax003()
    {
        return $this->render('max003');
    }

    public function actionMax004()
    {
        return $this->render('max004');
    }

    public function actionMax005()
    {
        return $this->render('max005');
    }

    public function actionMax006()
    {
        return $this->render('max006');
    }

    public function actionMax007()
    {
        return $this->render('max007');
    }

    public function actionMax008()
    {
        return $this->render('max008');
    }

    public function actionMax009()
    {
        return $this->render('max009');
    }

    public function actionMax010()
    {
        return $this->render('max010');
    }

    public function actionMax011()
    {
        return $this->render('max011');
    }

    public function actionMax012()
    {
        return $this->render('max012');
    }

    public function actionMax013()
    {
        return $this->render('max013');
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
