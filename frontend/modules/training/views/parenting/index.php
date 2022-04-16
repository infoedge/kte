<?php

use yii\helpers\Url;
use yii\helpers\Html;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use frontend\modules\training\models\Videolist;

/* @var $this yii\web\View */
$this->title= 'Relationships and Parenting';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
<div class="row">
<ol>
    <div class="col-sm-6">
    <li><?=Html::a('Relationships',['/training/parenting/rel001'])?></li>
    <li><?=Html::a('The Science Behind Good Parenting',['/training/parenting/par001'])?></li>
    <li><?=Html::a('Reasons For Parental Participation In Children Growth',['/training/parenting/par002'])?></li>
    <li><?=Html::a('Profitable Offline Business Ideas',['/training/parenting/par003'])?></li>
    <li><?=Html::a('Dealing With Small Children',['/training/parenting/par004'])?></li>
    </div>
    <div class="col-sm-6">
    <li><?=Html::a('Children And Friends',['/training/parenting/par005'])?></li>
    <li><?=Html::a('Addressing Problems In School',['/training/parenting/par006'])?></li>
    <li><?=Html::a('Parenting Teens',['/training/parenting/par007'])?></li>
    <li><?=Html::a('Parenting And Talent Development',['/training/parenting/par008'])?></li>
    <li><?=Html::a('Parenting And Career Development',['/training/parenting/par009'])?></li>
    </div>
</ol>
</div>
<hr>
    <?php $form = ActiveForm::begin(); ?>
    <?php Pjax::begin() ?>

    <div class="forex-video">
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'vid')->dropdownList(ArrayHelper::map(Videolist::find()->where(['vTopic' => 8])->all(), 'vid', 'vName'), ['prompt' => '-Select Video-'])->label('Video Name') ?>
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
        $.get("index.php?r=training/cryptocurrency/build-link",
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

