<?php

use yii\helpers\Url;
use yii\bootstrap\Carousel;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Home';
//$pic1= Url::to(['/images/carousal/networkingOnMobileAndWeb.jpg'],true); 
//$pic2 = Url::to(['/images/carousal/global-networking.jpg'],true);
//$pic3 = Url::to(['/images/carousal/networking-with-cloud-services.jpg'],true);

$pic1= 'images/carousal/networkingOnMobileAndWeb.jpg'; 
$pic2 = 'images/carousal/global-networking.jpg';
$pic3 = 'images/carousal/networking-with-cloud-services.jpg';
$pic4 = 'images/carousal/knowledge-to-earn-services-offered2.jpg';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
!empty($sponsor)?$this->params['breadcrumbs'][] = 'Your Referrer: '.$memberName.'; No: '.$sponsor:'';
$getreq = Yii::$app->request;
?>
<div class="site-index">
    <?= Carousel::widget([
        'items'=>[
            [
                'content'=>'<img src="'.$pic4.'">', 
                'options'=> ['alt'=>"knowledge-to-earn-services-offered", 'class'=>"d-block w-100"], 
            ],
            [
            'content'=>'<img src="'.$pic1.'">', 
            'options'=> ['alt'=>"NetworkingOnMobileAndWeb", 'class'=>"d-block w-100"],
            ],
            /*[
                'content'=>'<img src="'.$pic2.'">', 
                'options'=> ['alt'=>"global-networking", 'class'=>"d-block w-100"], 
            ],*/
            [
                'content'=>'<img src="'.$pic3.'">', 
                'options'=> ['alt'=>"networking-with-cloud-services", 'class'=>"d-block w-100"], 
            ],
            
        ],
        'options'=>[
            'id'=>'maincarousal',
            'interval'=>'6000',
        ],
    ]);?>
    
    <!--<div class="jumbotron">
    <h1>Knowledge to Earn!</h1>

    <p class="lead">
    <div class="col-sm-12 topimg"><img src="../web/images/knowledge_to_earn_Logo1.jpg"></div>
    </p>

    
</div>-->

<div class="body-content">

    <div class="row">
        <div class="col-lg-12 text-center" id="intro">
            
        
<p style="font-size: 2.0rem; color: navy; margin-top: 20px">Are you ambitious? Would you like to improve your lifestyle?</p>
<p style="font-size: 2.0rem; color: purple; margin-top: 20px">Would you like to gain the knowledge and skills to identify opportunities, create wealth, and experience success in life?</p>
<p style="font-size: 2.2rem; color: green; margin-top: 20px">If your answer to these questions is YES, then you have landed in the right place!</p>
<p style="font-size: 2.2rem; color: black; margin-top: 20px">Here, we offer <strong>two</strong> main opportunities:-</p>
<p ><ol type="1" style="font-size: 2.0rem; color: orange; margin-top: 20px">
    <li>Training and mentorship for wealth creation and personal development</li>
    <li style="margin-top: 10px">Business opportunity where you earn daily income by referring others.</li>
</ol></p>
<p style="font-size: 2.0rem; color: grey; margin-top: 20px">Earn over 100 USD per day.</p>
<p style="font-size: 2.0rem; color: black; margin-top: 20px"><i>Membership is by invitation and subscription only;</i></p>
<p style="font-size: 2.2rem; color: black; margin-top: 20px">Subscription Packages (One Time Fee)</p>
<p><div class="row" type="none" style="font-size: 2.0rem; color: red; margin-top: 10px">
    <div class="col-sm-1 col-sm-offset-3"><?= Html::img('@web/images/diamond.jpg',[ 'alt'=>'Diamond package','class'=>'img-responsive img-circle', 'width'=>'50px','style'=>'margin:10px,100px,0px,0px']) ?></div><div class="col-sm-8" style="text-align: left"> Diamond (Business) package (50 USD.)</div>
</div>
<div class="row" type="none" style="font-size: 2.0rem; color: red; margin-top: 10px">
    <div class="col-sm-1 col-sm-offset-3"><?= Html::img('@web/images/Gold2.jpg',['alt'=>'Gold package','class'=>'img-responsive img-circle', 'width'=>'50px', 'style'=>'margin:10px,100px,0px,0px']) ?></div><div class="col-sm-8" style="text-align: left"> Gold (Student) package (25 USD.)</div>
</div></p>
<p style="font-size: 2.4rem; color: navy; margin-top: 20px; " b>Join the ever growing membership across the globe.</p>
<hr>

            

            
        </div>
        <div class="col-sm-1">
            
        </div>
        <div class="col-sm-2">
            <p><a class="btn btn-warning btn-block btn-lg" href="<?= ( !empty($getreq->get('sponsor'))? Url::to(['/site/join', 'sponsor' => $getreq->get('sponsor')]):Url::to(['/site/signup'])) ?>">Register &raquo;</a></p>
        </div>
        <div class="col-sm-2">
            
        </div>
        <div class="col-sm-2">
            <p><a class="btn btn-primary btn-block btn-lg" href="<?= Url::to(['site/login']) ?>">My Account &raquo;</a></p>
        </div>
        <div class="col-sm-2"></div>
        <div class="col-sm-2 ">
            <p><a class="btn btn-success btn-block btn-lg" href="<?= Url::to(['site/contact']) ?>">Contact Us &raquo;</a></p>
        </div>
        <div class="col-sm-1">
            
        </div>
    </div>
    <div class="row">
        
    </div>

</div>
</div>
