<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use frontend\modules\training\models\Videolist;
use frontend\modules\training\models\Videotopics;
use frontend\modules\training\models\Videotypes;

/* @var $this yii\web\View */
$this->title = 'Forex Trading';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="forex-index">
    <ol>
        <div class="row">
            <div class="col-sm-4">
                <li><?= Html::a('What Is Forex?', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('Why Do People Trade In Forex?', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('Who Trades Forex?', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('The Structure Of Forex Trading.', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('Commonly Used Currency Pairs', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('The Bid-Ask Spread', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('What Are Bullish And Bearish Markets?', ['/training/forex/for001']) ?></li>
            </div>
            <div class="col-sm-4">
                <li><?= Html::a('What Is Long In Forex Trade?', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('What Is Short In Forex Trade?', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('What Are Pending Orders In Forex Trade?', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('What Is Leverage?', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('What Is Margin?', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('Hedging', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('Major Currencies.', ['/training/forex/for001']) ?></li>
            </div>
            <div class="col-sm-4">
                <li><?= Html::a('Different Trade Systems On Forex.', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('Types Of Market Analysis.', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('Fundamental Analysis', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('Kinds Of Foreign Exchange Markets', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('Technical Indicators.', ['/training/forex/for001']) ?></li>
                <li><?= Html::a('How To Learn To Trade Forex.', ['/training/forex/for001']) ?></li>
            </div>
        </div>
    </ol>

    <?php $form = ActiveForm::begin(); ?>
    <?php Pjax::begin() ?>

    <div class="forex-video">
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'vid')->dropdownList(ArrayHelper::map(Videolist::find()->where(['vTopic' => 1])->all(), 'vid', 'vName'), ['prompt' => '-Select Video-'])->label('Video Name') ?>
            </div>
            <div class="col-sm-2">
                <br><?= Html::submitButton(Yii::t('app', 'Change Video'), ['class' => 'btn btn-success','id'=>'btn1']) ?>
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
        $.get("index.php?r=training/forex/build-link",
             { id : id  },
             function(data){
                   var  result= $.parseJSON(data);
                   //alert(result.thelink);
                   //alert(data);
                   $('#videolist-thelink').val(result.thelink);
                   $('#videolist-thelink').val(result.thelink);
                   //$('#videoname').html(result.vName);
        });
        
    });
 });
JS;
    $this->registerJs($script);
    ?>
</div>
