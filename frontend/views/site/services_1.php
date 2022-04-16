<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$isLoggedIn= Yii::$app->user->isGuest?0:1;
$this->title = 'Services';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor)?$this->params['breadcrumbs'][] = "Your Referrer: ".$refmodel->memberName." - Member No: ".$refmodel->sponsor:'';
?>
<div clsss="site-products">
    <h1><?= Html::encode($this->title) ?></h1>
    <input type="hidden" id="isLoggedIn" value="<?=$isLoggedIn?>">
    <p>Knowledgetoearn.com is a training and mentorship platform for the knowledge which is necessary but not learnt in schools.
        To ensure that a person succeeds in this ever changing world, we believe that it is necessary to be equipped with practical knowledge which an individual can use to better his/her life in addition to the skills they have acquired in their schooling years.
        The trainings are categorized as follows.</p>
    <div class="row">
        <div class="col-sm-4">
            <h2 id="chck_1"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#enterprenuership'?>">Practical Steps to Entrepreneurship.</a></h2>
            <p id="teaser-text"><img class="img-circle img-responsive img-intro-rgt" src="<?= 'images/enterprenuership2.jpg'?>"  height="120px" >Most people would like to be entrepreneurs, but they have no idea where to start and which line of business is fit for them. Some don’t even know the Global trends and which business is more profitable.
                Our work here is to help such a person know how to develop and be a great entrepreneur.</p>
            <p><a>Topics</a><span id="topics_1"> covered :
                    <ol type="1">
                        <li>Who is an Entreprenuer?</li>
                        <li>Ways To Becoming An Entrepreneur</li>
                        <li>Profitable Offline Business Ideas</li>
                        <li>The Advantages Of Being An Entrepreneur</li>
                        <li>Disadvantages Of Entrepreneurship</li>
                    </ol>
                    </span>
            </p>
        </div>
        <div class="col-sm-4">
            <h2 id="chck_2"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#networkmarketing'?>">Network Marketing.</a></h2>
            <pid="teaser-text">Network marketing Industry is the fastest growing industry in the world today and hence the need for people to know how to succeed in this industry. They also need to know the different types of Compensation plans<div id="img-cente"><img class="img-rounded img-intro-lft" src="<?= 'images/network-marketing1.jpg'?>" width = "150px"  ></div> and how to choose the best to fit their aspirations.
                This platform will also get to train the subscribers how to choose a genuine company to ensure that they don’t Join scams and lose their hard earned Money.
               </p>
               <p>
                   <span id="topics_2">
               <ol type="1">
                   <li>Compensation  Plans  For Network  Marketing.</li>
                   <li>History  Of Network  Marketing  In The  World</li>
                   <li>Benefits  Of Network  Marketing  To  The  Economy.</li>
                   <li>Benefits  Of Network  Marketing  To  Companies  Involved.</li>
                   <li>Benefits  To  Network  Marketing  Enterpreneurs</li>
               </ol>
                       </span>
                </p>
        </div>
        <div class="col-sm-4">
            <h2 id="chck_3"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#cryptocurrency'?>">Cryptocurrency.</a></h2>
            <p id="teaser-text"><img class="img-circle img-responsive img-intro-lft" src="<?= 'images/cryptocurrency2.jpg'?>"  height="120px">Crypto currencies or simply digital money is another upcoming industry in which most people have questions with regard to Bitcoin and other Digital Coins and how they can benefit from them. How profitable are they, How can one trade the Cryptos for profitability.
                Our platform will provide insights into the cryptocurrency world and how an individual can benefit from the Trends.</p>
        </div>
    </div>

    <div class="row">

        <div class="col-sm-4">

            <h2 id="chck_4"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#forextrading'?>"> Forex Trading.</a></h2>
            <p id="teaser-text">The knowledge concerning the Forex trading is a very important when it comes to online opportunities. At Knowledgetoearn.com we will seek to answer some basic questions with regards to Forex trading and how an individual can benefit from global trends in Forex market.
                <img class="img-rounded img-responsive" src="<?= 'images/forex2.jpg'?>"  height="120px" ></p>
        </div>
        <div class="col-sm-4">

            <h2 id="chck_5"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#onlinebusiness'?>"> Online Business Opportunities.</a></h2>
            <p id="teaser-text">As we know, the world is now a global village and therefore online opportunities are all over in the internet, made possible by the fact that people from each and every continent can collaborate at any particular time.
                This has been made possible by advancement in Technology.
                We will give knowledge of the available online opportunities to help our subscribers benefit from the global trends.</p>
        </div>

        <div class="col-sm-4">

            <h2 id="chck_6"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#socialmediamarketing'?>">Social Media Marketing.</a></h2>
            <p id="teaser-text">We are also concerned on how our subscribers reach out to the world through social media platforms. How to maximize the likes of Facebook, Instagram, LinkedIn, etc.
                <img class="img-circle img-responsive img-intro-rgt" src="<?= 'images/social-media2.jpg'?>"  height="120px" >There is a lot of business in the internet if you get to learn how to reach the masses through Social media platforms.</p>
            <p>
                <span id="topics_3">
                    <ol type="1">
                        <li>Introduction To Social Media Marketing</li>
                        <li>The Five Core Pillars Of Social Media Marketing</li>
                    </ol>

                    

                </span>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <h2 id="chck_7"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#jobsearchingskills'?>">Job Searching Skills.</a></h2>
            <p id="teaser-text">We have many Graduates who have no requisite knowledge on how to prepare themselves for Job Search. How to prepare for Job interviews, How to better themselves in personal branding, how to write a winning CV and exactly where to get these Jobs.
                <img class="img-rounded img-responsive img-intro-rgt" src="<?= 'images/jobsearch2.jpg'?>"  height="120px" >Our mandate here is to give the much needed knowledge of how to land that dream Job.</p>
        </div>
        <div class="col-sm-4">

            <h2 id="chck_8"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#healthandfitness'?>">Health and Fitness Training.</a></h2>
            <p id="teaser-text">Health and fitness are the two aspects which affect our bodies directly.<img class="img-circle img-intro-rgt" src="<?= 'images/health-and-fitness1.jpg'?>" xwidth = "120px" height="120px" >
                How to take care of one’s health through Proper nutrition, Supplementation and Exercises will be in our training and motivational series.</p>
        </div>
        <div class="col-sm-4">

            <h2 id="chck_9"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#maximizingonespotential'?>">Maximizing Ones Potential.</a></h2>
            <p id="teaser-text">Each and every person has a dream to achieve and hence the need to help our subscribers to know the necessary Life Skills needed to ensure that everyone is achieving their goals and Aspirations. 
                Could it be in the work place, in School, in talent development? How do you ensure that you reach the peak of your Aspirations? We will walk with you step by step to answer that Question.</p>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-4">

            <h2 ><a href="#teambuilding">Team Building.</a></h2>
            <p id="teaser-text">We all know that without proper team dynamics, it is very hard to achieve much; how do we create a winning team? <img class="img-circle img-intro-rgt" src="<?= 'images/team-building1.jpg'?>" xwidth = "120px" height="120px" > With a Proper TEAM, we are all winners in whichever work we are pursuing.
                We will be giving time to time tips on how to develop a winning team.</p>
        </div>
        <div class="col-sm-4">

            <h2><a href="#peaceeducation">Peace Education.</a></h2>
            <p id="teaser-text">Without Peace, there is no stability and hence the need to pursue peace in all our endeavors, We will partner with likeminded individuals and Organizations who are keen in preaching peace across the world to ensure that Our subscribers are well Educated when it comes to maintaining peace.
        </div>
        <div class="col-sm-4">

            <h2 id="chck_12"><a href="<?= $isLoggedIn?Url::to(['/dashboard/membership/training']):'#relationshipsandparenting'?>">Relationships and Parenting.</a></h2>
            <p id="teaser-text">The world can only advance in the right direction if we maintain Healthy relationships with each other and develop love amongst ourselves.
                <img class="img-circle img-responsive img-intro-rgt" src="<?= 'images/parenting-parent-child-relationships-family-mom-dad-baby2.jpg'?>"  height="120px" >
                There are principles regarding all these aspects and it is our objective to ensure that our subscribers are an example to many other people out there.
                Parenting of the young ones is also important to ensure that we have a great tomorrow.</p>
        </div>
    </div>
<?php
$script = <<< JS
   $(function(){
      $('[id^="chck_"]').click(function(){
            var isLoggedIn = $('#isLoggedIn').val();
            if(isLoggedIn==0){
                alert('Please login first to read more on this content!');
            }
        });   
   });   
JS;
$this->registerJs($script);
?>
</div>
