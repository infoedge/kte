<?php

use yii\helpers\Url;
use yii\helpers\Html;

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use frontend\modules\training\models\Videolist;

/* @var $this yii\web\View */
$this->title = 'Cryptocurrency';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
<div class="row">
<ol>
    <div class="col-sm-4">
    <li><?= Html::a('What Is A Cryptocurrency?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('Is Cryptocurrency Real Money?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Is The Difference Between A Digital Currency And A Cryptocurrency?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('Which Was The First Cryptocurrency?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('How Are Cryptocurrency Stored?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('Types Of Cryptocurrency Wallets.', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('How Many Cryptocurrencies Are There?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Is Cryptocurrency Mining?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('How Does One Acquire A Cryptocurrencies?', ['/training/cryptocurrency/crypto001']) ?></li>
    </div>
    <div class="col-sm-4">
    <li><?= Html::a('Why Cryptocurrencies Work.', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Is A Blockchain? ', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('How Does One Invest In Cryptocurrencies?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Is Cryptocurrency Trading?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('Buying And Selling Cryptocurrencies Via An Exchange', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('Exchangers.', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('Entering The Market.', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Moves Cryptocurrency Markets?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('How Do Cryptocurrency Markets Work?', ['/training/cryptocurrency/crypto001']) ?></li>
    </div>
    <div class="col-sm-4">
    <li><?= Html::a('How Does Cryptocurrency Trading Work?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Is The Spread In Cryptocurrency Trading?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Is A Lot In Cryptocurrency Trading?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Is Leverage In Cryptocurrency Trading?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('How Does Leverage Work?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Is Margin In Cryptocurrency Trading?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('What Is A Pip In Cryptocurrency Trading?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('Procedure Of Trading Cryptocurrency?', ['/training/cryptocurrency/crypto001']) ?></li>
    <li><?= Html::a('Common  Bitcoin Myths Debunked', ['/training/cryptocurrency/crypto001']) ?></li>
    </div>
</ol>
    <hr>
    <?php $form = ActiveForm::begin(); ?>
    <?php Pjax::begin() ?>

    <div class="forex-video">
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($model, 'vid')->dropdownList(ArrayHelper::map(Videolist::find()->where(['vTopic' => 9])->all(), 'vid', 'vName'), ['prompt' => '-Select Video-'])->label('Video Name') ?>
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
</div>
</p>
