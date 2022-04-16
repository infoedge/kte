<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\video\models\Videolist */

$this->title = Yii::t('app', 'Add to Video List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Videos'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videolist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <hr>
    <h3>Listed Videos</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vName',
            ['attribute'=>'vTopic0.topicName',],
            [
                'attribute'=>'videoType0.typeName',
                //'value'=>'videoType0.typeName',
                ],
            'vid',
            'vDesc',
            
            'order',
            //'fromDate',
            //'toDate',

            ['class' => 'yii\grid\ActionColumn',
                'template' =>'{update}&nbsp;&nbsp;{move}',
                'buttons' =>[
                    'move'=>function ($url, $model) {
                           return Html::a( '<span class="glyphicon glyphicon-move" id="moveicon" title="Reorder" ></span>',  ['move','id'=>$model->id]);
                            },
                ]
                ],
        ],
    ]); ?>

</div>
<?php //'videolist-vtopic
$script = <<< JS
$(function (){
    
    $('#videolist-vtopic').change( function(){
        var id = $(this).val();
        
        //alert("Topic: " + id) ;
        $.get("index.php?r=video/videolist/next-serial",
             { id : id  },
             function(data){
                   var  result= $.parseJSON(data);
                   //alert(result.order);
                   //alert(data);
                   //$('#videolist-order').val(data);
                   $('#videolist-order').val(result.order);
        }); 
    });
 });
JS;
$this->registerJs($script);
?>