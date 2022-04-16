<?php

use yii\helpers\Url;
use yii\bootstrap\Carousel;

/* @var $this yii\web\View */

$this->title = 'Home';
//$pic1= Url::to(['/images/carousal/networkingOnMobileAndWeb.jpg'],true); 
//$pic2 = Url::to(['/images/carousal/global-networking.jpg'],true);
//$pic3 = Url::to(['/images/carousal/networking-with-cloud-services.jpg'],true);

$pic1 = 'images/carousal/networkingOnMobileAndWeb.jpg';
$pic2 = 'images/carousal/global-networking.jpg';
$pic3 = 'images/carousal/networking-with-cloud-services.jpg';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
!empty($sponsor) ? $this->params['breadcrumbs'][] = 'Your Referrer: ' . $memberName . '; No: ' . $sponsor : '';
?>
<div class="site-index">
    <?=
    Carousel::widget([
        'items' => [
            [
                'content' => '<img src="' . $pic1 . '">',
                'options' => ['alt' => "NetworkingOnMobileAndWeb", 'class' => "d-block w-100"],
            ],
            [
                'content' => '<img src="' . $pic2 . '">',
                'options' => ['alt' => "global-networking", 'class' => "d-block w-100"],
            ],
            [
                'content' => '<img src="' . $pic3 . '">',
                'options' => ['alt' => "networking-with-cloud-services", 'class' => "d-block w-100"],
            ],
        ],
        'options' => [
            'id' => 'maincarousal',
            'interval' => '6000',
        ],
    ]);
    ?>

    <!--<div class="jumbotron">
    <h1>Knowledge to Earn!</h1>

    <p class="lead">
    <div class="col-sm-12 topimg"><img src="../web/images/knowledge_to_earn_Logo1.jpg"></div>
    </p>

    
</div>-->

    <div class="body-content">
        <div class="row first-statement">
            <div class="col-sm-12 first-statement">
                <h1>Overview</h1>
                <p>Joining knowledgetoearn.com gives an assurance that one has, at their fingertips, the capacity to quickly gain the skills, 
                    understanding and expertise to not only charter 
                    the new and emerging technologies and techniques, opening new earning frontiers, but also bridge gaps in the understanding of the old 
                    and unavoidable skills, such as relationships and parenting and maximizing potential, 
                    and that are necessary for healthy fruitful living. </p>

                <p>For a starting one time fee subscribing to one of two packages 
                     one <strong>also</strong> joins an affiliate program where they can earn in five ways by ensuring 
                    their friends, family and associates join too to benefit from this 
                    amazing product.
                    <p>All this is done from anywhere, at anytime. </p>
                    <div id="callout1"></div></p>
                
                <p><strong>This is the Information Age where knowledge is power and wealth.</strong></p>
                
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 first-statement">
                <h2>About Us</h2>

                <p>Knowledgetoearn.com is an online Educational platform, Created by Optimum Performance Solutions LLC dealing with Training and Mentorship for growth across the globe, 
                    helping individuals maximize their Personal and Economic potentials. On this platform members access unparalleled content...</p>

                <p><a class="btn btn-success btn-block" href="<?= Url::to(['site/about']) ?>">...More About Us &raquo;</a></p>
            </div>
            <div class="col-lg-4 first-statement">
                <h2>Services</h2>

                <p>This is a training and mentorship platform to impart the skills necessary to bridge the gap between life's requirements and formal school education.
                It ensures that a member, in this ever changing world, we believe, is equipped with the necessary practical skills to objectively deal with life's situations... 
            </p>

                <p><a class="btn btn-primary btn-block" href="<?= Url::to(['site/services']) ?>">...More on Services &raquo;</a></p>
            </div>
            <div class="col-lg-4 first-statement">
                <h2>Opportunity</h2>

                <p>By joining our affiliate program you are becoming part of a community where we are all ready to better our lives by guided Personal and Economic growth.
                Remember on our platform, we add value in helping members to become more competitive while providing an opportunity to earn in five ways...
            </p>

                <p><a class="btn btn-warning btn-block" href="<?= Url::to(['site/opportunity']) ?>">...More on Opportunity  &raquo;</a></p>
            </div>
        </div>

    </div>
<?php
$script = <<<JS
$(function(){
    $('#callout1').hide();
    
});
JS;
$this->registerJs($script);
?>
</div>
