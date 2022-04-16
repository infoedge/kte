<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use frontend\modules\training\models\Videolist;

/* @var $this yii\web\View */
$this->title= 'Practical Steps to Enterprenuership';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
<ol>
    <div class="row">
         <div class="col-sm-6">
    <li><?=Html::a('Who is an Entreprenuer?',['/training/entreprenuer/entre001'])?></li>
    <li><?=Html::a('Ways To Becoming An Entrepreneur',['/training/entreprenuer/entre002'])?></li>
    <li><?=Html::a('Profitable Offline Business Ideas',['/training/entreprenuer/entre003'])?></li>
         </div>
        <div class="col-sm-6">
    <li><?=Html::a('The Advantages Of Being An Entrepreneur',['/training/entreprenuer/entre004'])?></li>
    <li><?=Html::a('Disadvantages Of Entrepreneurship',['/training/entreprenuer/entre005'])?></li>
        </div>
    </div>
</ol>
 <?php $form = ActiveForm::begin(); ?>
    <?php Pjax::begin() ?>

    <div class="forex-video">
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'vid')->dropdownList(ArrayHelper::map(Videolist::find()->where(['vTopic' => 2])->all(), 'vid', 'vName'), ['prompt' => '-Select Video-'])->label('Video Name') ?>
            </div>
            <div class="col-sm-2">
                <br><?= Html::submitButton(Yii::t('app', 'Change Video'), ['class' => 'btn btn-success']) ?>
                <br><?= ' '. $videoCount .' Videos Available'?>
            </div>
        </div>
        <?= $form->field($model, 'thelink')->hiddenInput()->label(false); ?>
        <?= $form->field($model, 'vName')->hiddenInput()->label(false); ?>
        <div class="row">
            <!--<div class="col-sm-3"><span id="videoname"><?= $model->vName ?></span></div><div class="col-sm-3"><span id="videodesc"><?= $model->vDesc ?></span></div>-->
            <div class="col-sm-offset-1"><span id="videoname"><?= $model->vName ?> <?= !empty($model->vDesc)?'- '.$model->vDesc:'' ?></span>
        </div>
        <div class="embed-responsive embed-responsive-16by9">
            <iframe  src="<?= $model->thelink ?>" title="<?= $model->vName ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>

            </iframe>
        </div>
    </div>
    <?php Pjax::end(); ?>
    <?php ActiveForm::end(); ?>
    <?php
    $script = <<< JS
$(function (){
    
    $('#videolist-vid').change( function(){
        var id = $(this).val();
        
        //alert("video: " + id) ;
        $.get("index.php?r=training/enterprenuer/build-link",
             { id : id  },
             function(data){
                   var  result= $.parseJSON(data);
                   //alert(result.thelink);
                   //alert(data);
                   $('#videolist-thelink').val(result.thelink);
                   $('#videolist-vName').val(result.vName);
        }); 
    });
 });
JS;
    $this->registerJs($script);
    ?>
</p>
