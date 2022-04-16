<?php

use yii\helpers\Url;
use yii\bootstrap\Carousel;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Home';
//$pic1= Url::to(['/images/carousal/networkingOnMobileAndWeb.jpg'],true); 
//$pic2 = Url::to(['/images/carousal/global-networking.jpg'],true);
//$pic3 = Url::to(['/images/carousal/networking-with-cloud-services.jpg'],true);

$pic1 = 'images/carousal/ideasInTheHand1.jpg';
$pic2= 'images/carousal/whichWayNext_1320x770.jpg'; 
$pic3 = 'images/carousal/whereToStartEntreprenuer5_1320x770.jpg';
$pic4 = 'images/carousal/networking1_1320x770.jpg';
$pic5 = 'images/carousal/growYourMoney1320x770.jpg';
$pic6 = 'images/carousal/roadToSuccess.jpg';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
!empty($sponsor)?$this->params['breadcrumbs'][] = 'Your Referrer: '.$memberName.'; No: '.$sponsor:'';
$getreq = Yii::$app->request;
?>
<div class="home-index">
    <?= Carousel::widget([
        'items'=>[
            /*[
                'content'=>'<img src="'.$pic1.'" class="img-responsive">', 
                'caption' => '<span class="mycaptionsred topright"><h2>Life\'s Quandry </h2><h3>You probably have a have some business ideas at hand but ...?</h3></span>',
                'options'=> ['alt'=>"You-have=ideas-in-your-hand", 'class'=>"d-block w-100" ],
                ],*/
            [
                'content'=>'<img src="'.$pic2.'" class="img-responsive">', 
                'caption' => '<span class="mycaptionsblue topleft"><h3>Which way now?</h3><h4>You have reached a fork in life. the future is cloudy. You ask yourself which way next?</h4></span>',
                'options'=> ['alt'=>"NetworkingOnMobileAndWeb", 'class'=>"d-block w-100" ],
                ],
            [
                'content'=>'<img src="'.$pic3.'" class="img-responsive">',
                'caption' => '<span class="mycaptionsgreen" id="top-right"><h3>Learn</h3><h4>Register and clarify the issues in contemporary business landscape for a one time fee.</h4></span>',
                'options'=> ['alt'=>"global-networking", 'class'=>"d-block w-100"], 
            ],
            [
                'content'=>'<img src="'.$pic4.'" class="img-responsive">', 
                'caption' => '<span class="mycaptionsyellow"><h3>Share</h3><h4>Share this platform by networking with your friends, associates and relatives while you earn</h4></span>',
                'options'=> ['alt'=>"networking-with-cloud-services", 'class'=>"d-block w-100" ], 
            ],
            [
                'content'=>'<img src="'.$pic5.'" class="img-responsive">', 
                'caption' => '<span class="mycaptionsred"><h3>Earn</h3><h4> Watch your earnings grow from the affiliate program and the various methods this platform presents</h4></span>',
                'options'=> ['alt'=>"networking-with-cloud-services", 'class'=>"d-block w-100" ], 
            ],
            /*[
                'content'=>'<img src="'.$pic6.'" class="img-responsive">', 
                'caption' => '<span class="mycaptionsyellow"><h3>Success</h3><h4>You are now on the road to success</h4></span>',
                'options'=> ['alt'=>"networking-with-cloud-services", 'class'=>"d-block w-100" ], 
            ],*/
        ],
        'options'=>[
            'id'=>'maincarousal',
            'interval'=>'8000',
            'transition' => 2000,
        ],
    ]);?>
    
</div>
<div class="container">
    <!--<div class="row">
        <div class="col-md-6 col-sm-12 frontpage-img">
            <?= Html::img("@web/images/frontpage/entreprenuer3.jpg", ['alt'=>'ChallengesOfSuccess', 'width'=>'400px'] ) ?>
        </div>
        <div class="col-md-6 col-sm-12 intropara1">
            Update yoursef with the knowledge and skills to become a success in todays contemporary business arena.
        </div>
    </div>-->
</div>