<?php

use yii\helpers\Url;
use yii\helpers\Html;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use frontend\modules\training\models\Videolist;

/* @var $this yii\web\View */
$this->title = 'Maximizing Ones Potential';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
<div class="row">
    <ol>
        <div class="col-sm-4">
            <li><?= Html::a('What Does Life Entail', ['/training/maxpotential/max001']) ?></li>
            <li><?= Html::a('Personal Development Goals', ['/training/maxpotential/max002']) ?></li>
            <li><?= Html::a('21st Century Skills', ['/training/maxpotential/max003']) ?></li>
            <li><?= Html::a('Personal Branding', ['/training/maxpotential/max004']) ?></li>
            <li><?= Html::a('Life Skills', ['/training/maxpotential/max005']) ?></li>
        </div>
        <div class="col-sm-4">
            <li><?= Html::a('Understanding Discipline', ['/training/maxpotential/max006']) ?></li>
            <li><?= Html::a('Understanding Character', ['/training/maxpotential/max007']) ?></li>
            <li><?= Html::a('Understanding Personality Types', ['/training/maxpotential/max008']) ?></li>
            <li><?= Html::a('MBTI Personality Type Test', ['/training/maxpotential/max009']) ?></li>
        </div>
        <div class="col-sm-4">
            <li><?= Html::a('Dealing With Peer Pressure', ['/training/maxpotential/max010']) ?></li>
            <li><?= Html::a('Qualities Of An Effective Trainer', ['/training/maxpotential/max011']) ?></li>
            <li><?= Html::a('Key Areas Of Development For Employees', ['/training/maxpotential/max012']) ?></li>
            <li><?= Html::a('TV And Internet Addiction', ['/training/maxpotential/max013']) ?></li>
        </div>
    </ol>
    <?php $form = ActiveForm::begin(); ?>
    <?php Pjax::begin() ?>

    <div class="forex-video">
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'vid')->dropdownList(ArrayHelper::map(Videolist::find()->where(['vTopic' => 4])->all(), 'vid', 'vName'), ['prompt' => '-Select Video-'])->label('Video Name') ?>
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
        $.get("index.php?r=training/maxpotential/build-link",
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
</div>
</p>
