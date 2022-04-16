<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$isLoggedIn = Yii::$app->user->isGuest ? 0 : 1;
$this->title = 'Services';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor) ? $this->params['breadcrumbs'][] = "Your Referrer: " . $refmodel->memberName . " - Member No: " . $refmodel->sponsor : '';
$getreq = Yii::$app->request;
?>
<div clsss="site-products">
    <h1><?= Html::encode($this->title) ?></h1>
    <input type="hidden" id="isLoggedIn" value="<?= $isLoggedIn ?>">
    <p class="first-statement">Knowledgetoearn.com is a training and mentorship platform for the expertise necessary to deal with life's ever changing socio-economic issues but not learnt in formal schooling.
        To ensure that a person succeeds in this ever changing world, we believe that it is necessary to be equipped with practical understanding which an individual can use to better their lives in addition to the skills they have acquired in their schooling years.
        The training modules are categorized as follows.</p>
    <div class="row">
        <div class="col-sm-6">
            <h2 id="chck_1"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#enterprenuership' ?>">Practical Steps to Entrepreneurship.</a></h2>
            <p id="teaser-text"><img class="img-circle img-responsive img-intro-rgt" src="<?= 'images/enterprenuership2.jpg' ?>"  height="120px" >
                Most people would like to be entrepreneurs, but they have a vague idea where to start and which line of business is fit for them. 
                Some may not even appreciate the impact of Global trends, which business is more profitable and how universal trends and other concerns may affect their concern.
                Our work here is to help such a person understand how to develop and be a great entrepreneur.</p>
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
        <div class="col-sm-6">
            <h2 id="chck_2"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#networkmarketing' ?>">Network Marketing.</a></h2>
            <p id="teaser-text">Network marketing Industry is one of the fastest growing industries in the world today and hence the need for people to gain familiarity with ways of succeeding in this industry. They also need to grasp the different types of Compensation plans available
            <div id="img-cente"><img class="img-rounded img-intro-lft" src="<?= 'images/network-marketing1.jpg' ?>" width = "150px"  ></div> and how to choose the best fit to their aspirations.
            This platform will also get to train the subscribers on how to choose a genuine company to ensure that they do not join scams and lose their hard earned Money.
            </p>
            <p>Topics covered include:-</p>
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
    </div>
    <div class="row">
        <div class="col-sm-6">

            <h2 id="chck_4"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#forextrading' ?>"> Forex Trading.</a></h2>
            <p id="teaser-text">Gaining mastery concerning the Forex trading is a very important when it comes to online opportunities. 
                At Knowledgetoearn.com we will seek to answer some basic questions with regards to Forex trading and how an individual can benefit from global trends in Forex market.
                <span id="topics_4">
                    <p>Topics covered include:-
                    <ul >
                        <li>1. What Is Forex?</li>
                        <li>2. Why Do People Trade In Forex?</li>
                        <li>3. Who Trades Forex?</li>
                        ....
                        <li>7. What Are Bullish And Bearish Markets?</li>
                        ....
                        <li>15. Different Trade Systems On Forex.</li>
                        ....
                        <li>19. Technical Indicators.</li>
                        <li>20. Learn how to Trade in Forex.</li>
                        </ol>
                </span>
                
                <img class="img-rounded img-responsive" src="<?= 'images/forex2.jpg' ?>"  height="120px" ></p>
            <p>This module is available to Diamond Package Members only</p>
        </div>
        <div class="col-sm-6">
            <h2 id="chck_3"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#cryptocurrency' ?>">Cryptocurrency.</a></h2>
            <p id="teaser-text"><img class="img-circle img-responsive img-intro-lft" src="<?= 'images/cryptocurrency2.jpg' ?>"  height="120px">Crypto currencies or simply digital money is another upcoming industry in which most people have questions with regard to Bitcoin and other Digital Coins and how they can benefit from them. How profitable are they, How can one trade the Cryptos for profitability.
                Our platform will provide insights into the cryptocurrency world and how an individual can benefit from the Trends.</p>
            <p>Some of the topics covered are as follows:-</p>
            <span id="topics_3">
                <ul >
                    <li>1. What Is A Cryptocurrency?</li>
                    <li>2. Is Cryptocurrency Real Money?</li>
                    <li>3. What Is The Difference Between A Digital Currency And A Cryptocurrency?</li>
                    .....
                    <li>10. Why Cryptocurrencies Work.</li>
                    .....
                    <li>25. Procedure Of Trading Cryptocurrency?</li>
                    <li>26. Common  Bitcoin Myths Debunked</li>
                    </ol>
            </span>
            <p>This module is available to Diamond Package Members only</p>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-6">

            <h2 id="chck_5"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#onlinebusiness' ?>"> Online Business Opportunities.</a></h2>
            <p id="teaser-text">As we know, the world is now a global village and therefore online opportunities are all over in the internet, made possible by the fact that people from each and every continent can collaborate at any particular time.
                This has been made possible by advancement in Technology.
                We will give enlightenment of the available online opportunities to help our members benefit from the global trends.</p>
            <p>Topics covered include:-</p>
            <span id="topics_5">
                <ol type="1">
                    <li>The Benefits Of An Online Internet Business</li>
                    <li>Description Of Seventy Three Business Ideas</li>

                </ol>
            </span>
            <p>This module is available to Diamond Package Members only</p>
        </div>

        <div class="col-sm-6">

            <h2 id="chck_6"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#socialmediamarketing' ?>">Social Media Marketing.</a></h2>
            <p id="teaser-text">We are also concerned on how our subscribers reach out to the world through social media platforms. How to maximize the likes of Facebook, Instagram, LinkedIn, etc.
                <img class="img-circle img-responsive img-intro-rgt" src="<?= 'images/social-media2.jpg' ?>"  height="120px" >There is a lot of business in the internet if you get to learn how to reach the masses through Social media platforms.</p>
            <p>
                <p>Topics covered include:-</p>
                <span id="topics_6">
                    <ol type="1">
                        <li>Introduction To Social Media Marketing</li>
                        <li>The Five Core Pillars Of Social Media Marketing</li>
                    </ol>
                </span>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <h2 id="chck_7"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#jobsearchingskills' ?>">Job Searching Skills.</a></h2>
            <p id="teaser-text">There are many Graduates who have no requisite skills on how to prepare themselves for Job Search. How to prepare for Job interviews, How to better themselves in personal branding, how to write a winning CV and exactly where to get these Jobs.
                <img class="img-rounded img-responsive img-intro-rgt" src="<?= 'images/jobsearch2.jpg' ?>"  height="120px" >Our mandate here is to give the much needed knowledge of how to land that dream Job.
                <span id="topics_7">
                    <p>Topics covered include:-</p>
                    <ul >
                        <li>1. Beginners Guide To Networking</li>
                        <li>2. Job Searching Skills</li>
                        ...
                        <li>6. Job Interviews</li>
                        <li>7. Role Of Volunteering In Job Search</li>
                    </ul>
                </span>
            </p>
        </div>
        <div class="col-sm-6">

            <h2 id="chck_8"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#healthandfitness' ?>">Health and Fitness Training.</a></h2>
            <p id="teaser-text">Health and fitness are the two aspects which affect our bodies directly.<img class="img-circle img-intro-rgt img-responsive" src="<?= 'images/health-and-fitness1.jpg' ?>" xwidth = "360px" height="360px" >
                How to take care of one’s health through Proper nutrition, Supplementation and Exercises will be in our training and motivational series.</p>
            <span id="topics_8">
                <p>Topics covered include:-</p>
                <ol type="1">
                    <li>Wellness And Individual Behaviour</li>
                    <li>Alcoholism And Drugs Abuse</li>
                    
                </ol>
            </span>
        </div>
    </div>
    <div class="row">  
        <div class="col-sm-6">

            <h2 id="chck_9"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#maximizingonespotential' ?>">Maximizing Ones Potential.</a></h2>
            <p id="teaser-text">Every person has a vision to achieve but may not have the grips on how to reach that dream. We help our members become adept with the necessary Life Skills needed to ensure that they is attaining their goals and aspirations. 
                It could  be in the work place, or in School, or in talent development. How can one ensure that they reach the peak of their ambitions? You are in the right place and space. We will walk with you step by step to answer that Question.</p>
            <img src="images/growing-flower-water-can-2-animated.gif" class="img-responsive img-circle img-intro-rgt" width="170px">
            <span id="topics_9">
                <p>Some of the topics covered include:-</p>
                <ul>
                    <li>1. What Does Life Entail</li>
                    <li>2. Personal Development Goals</li>
                    <li>3. 21st Century Skills</li>
                    ...
                    <li>7. Understanding Character</li>
                    ...
                    <li>12. Key Areas Of Development For Employees</li>
                    <li>13. TV And Internet Addiction</li>
                </ol>
            </span>
            <p>This module is available to Diamond Package Members only</p>
        </div>


        <div class="col-sm-6">

            <h2 ><a href="#teambuilding">Team Building.</a></h2>
            <p id="teaser-text">We all know that without proper team dynamics, it is very hard to achieve much; how do we create a winning team?  With a Proper TEAM, we are all winners in whichever work we are pursuing.
                We will be giving, from time to time, tips on how to develop a winning team.
                <!--<span id="topics_10">
                    <ol type="1">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ol>
                </span>-->
            </p>
            <img class="img-circle img-intro-rgt" src="<?= 'images/team-building1.jpg' ?>" width = "360px"  >
            <p>This module will be available to Diamond Package Members only</p>
            <p>Material to be uploaded ASAP</p>
            
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">

            <h2><a href="#peaceeducation">Peace Education.</a></h2>
            <p id="teaser-text">Without Peace, there is no stability and hence the need to pursue peace in all our endeavors, We will partner with likeminded individuals and Organizations who are keen in preaching peace across the world to ensure that Our subscribers are well Educated when it comes to maintaining peace.
                <!--<span id="topics_11">
                    <p>Topics covered include:-</p>
                    <ol type="1">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ol>
                </span>-->
                <p>Material to be uploaded ASAP</p>
        </div>
        
        <div class="col-sm-6">

            <h2 id="chck_12"><a href="<?= $isLoggedIn ? Url::to(['/dashboard/membership/training']) : '#relationshipsandparenting' ?>">Relationships and Parenting.</a></h2>
            <p id="teaser-text">The world can only advance in the right direction if we maintain Healthy relationships with each other and develop love amongst ourselves.
                <img class="img-circle img-responsive img-intro-rgt" src="<?= 'images/parenting-parent-child-relationships-family-mom-dad-baby2.jpg' ?>"  height="120px" >
                There are principles regarding all these aspects and it is our objective to ensure that our subscribers are an example to many other people out there.
                Parenting of the young ones is also important to ensure that we have a great tomorrow.
                <span id="topics_12">
                    <p>A glimpse at topics covered include:-</p>
                    <ul>
                        <li>1. Relationships</li>
                        <li>2. The Science Behind Good Parenting</li>
                        ...
                        <li>5. Dealing With Small Children</li>
                        <li>6. Children And Friends</li>
                        ...
                        <li>10. Parenting And Career Development</li>
                    </ol>
                </span>
            </p>
            <p>This module is available to Diamond Package Members only</p>
        </div>
    </div>
    <div class="row">
        <div class='col-sm-12'>
            <p><strong> <?= Html::a('Click here',['site/services-summary'])?> to view a <?= Html::a('summary of services',['site/services-summary'])?> available with respect to membership package.</strong></p>
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
