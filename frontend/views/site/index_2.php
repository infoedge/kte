<?php
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'Home';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Knowledge to Earn!</h1>

        <p class="lead">
        <div class="col-sm-12 topimg"><img src="../web/images/knowledge_to_earn_Logo1.jpg"></div>
        </p>

        
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4 text-center">
                <h2>About Us</h2>

    <p>Knowledgetoearn.com is an online Educational platform, Created by Optimum Performance Solutions LTD. dealing with Trainings and Mentorship for growth across the globe helping individuals maximize their Personal and Economic potentials.</p>

                <p><a class="btn btn-success btn-block" href="<?= Url::to(['site/about']) ?>">...More About Us &raquo;</a></p>
            </div>
            <div class="col-lg-4 text-center">
                <h2>Services</h2>

                <p>Knowledgetoearn.com is a training and mentorship platform for the knowledge which is necessary but not learnt in schools.
To ensure that a person succeeds in this ever changing world, we believe that it is necessary to be equipped with practical knowledge... 
</p>

                <p><a class="btn btn-primary btn-block" href="<?= Url::to(['site/services'])?>">...More on Services &raquo;</a></p>
            </div>
            <div class="col-lg-4 text-center">
                <h2>Opportunity</h2>

                <p>By Joining Knowledgetoearn.com you are becoming part of happy community where we are all ready to better our lives in Personal and Economic grounds.
        Remember in our platform, we add value in helping subscribers be in a position to be competitive ...
        </p>

                <p><a class="btn btn-warning btn-block" href="<?= Url::to(['site/opportunity'])?>">...More on Opportunity  &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
