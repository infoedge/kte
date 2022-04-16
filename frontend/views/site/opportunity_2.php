<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'Opportunity';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor)?$this->params['breadcrumbs'][] = "Your Referrer: ".$refmodel->memberName." - Member No: ".$refmodel->sponsor:'';
$getreq = Yii::$app->request;
?>
<div clsss="site-services">
    <h1><?= Html::encode($this->title) ?></h1>

<p>The primary opportunity is in our affiliate program which seeks to compensate
    members, who refer others, as a means of remuneration for the work done in 
    marketing this platform on our behalf. It ensures that the more a member 
    works the more they earn and that they also earn from the efforts of those 
    below them in their genealogy tree. This is a typical network marketing 
    scenario in practice.</p>
<p>There are two packages that one may join/register as a member with, 
    namely: Gold Package at twenty-five dollars ($25) and Diamond Package 
    for fifty dollars ($50). One may upgrade  from Gold package to Diamond 
    at any time by paying the difference in the package price.</p>
<p>On joining / registering every member shall be provided with a personalized 
    back office primarily starting with a dashboard, wallet, ability to view 
    your genealogy tree, summary of points value (PV) gained on an item by item basis, among others.</p>

<p>The back office is a system designed to ensure that the user is able to follow their earnings, get marketing links, place their proposed referees/ down lines where they want/ need, to maximize earnings. It is here that members shall make requests to withdraw from their wallet when a minimum threshold of twenty-five dollars ($25) is reached.</p>

<p>There are five ways to earn. The compensation plan, in brief, is as follows:-</p>
<h2>Sponsorship /Referral bonus</h2>
<p>Every time you directly introduce somebody who joins, you are awarded 10 Points Value (PV) if they register as a Gold Package member and 20 PV if they register as a Diamond Package member.</p>

<p>For those directly sponsored, you are paid, depending on your package. 
    You are paid fourty percent (40%) of your sponsored's package points if you 
    have a Diamond Package and thirty percent (30%) of their package points when
    your package is Gold. </p>
<p> Not only do you earn from those you introduce but also earn from those your 
    immediate sponsored member sponsors/refers to the tune of thirty percent(30%)of the
    new members PV if your package is Diamond,  and twenty percent (20%) of the 
    package points (PV)of the newcomer if your package is Gold. i.e You are paid up to two levels.</p>
<p>Clearly it is advantageous to have the bigger package</p>
<h2>Matching (Binary ) Bonus</h2>
<p>For anyone joining in your genealogy tree, (below you) you are awarded ten 
    (10) points for Gold and twenty (20) points for Diamond. These are placed 
    on the left or right in the Binary Tree. </p>

<p>Each time there are ten (10) points on the left and ten (10) points on the 
    right, you are receive two dollars ($2) irrespective of who brought 
    in(sponsored) the member.  Any balance of points on left or right is carried 
    forward.</p>

<p>Note that a member to benefit from this bonus, one must be a Diamond member and have already directly 
    sponsored one member on the left and one member on the right. Also note that 
    the maximum earning per day is  fifty dollars ($50) for a Gold Package member 
    and one hundred dollars ($100) for a Diamond Package member</p>

<h2>Team Bonus</h2>
<p>Every time your direct sponsored earns matching bonus, you are paid twenty percent (20%) of their earnings.</p>

<p>There is also compensation on the second level (those sponsored by those you have sponsored) of ten percent (10%) of second level matching bonus earnings.</p>

<h2>Rank Advancement</h2>
<p>The system keeps track of cumulative left and right points (see matching bonus above), and at the end of the month, awards members who have reached  certain cumulative points thresholds, higher,  ranks and a onetime cash award according to the following table</p>
<p><div class="row">
    <div class="col-sm-offset-1">
<table class =" table table-striped" style="align-items: center">
    <thead>
        <tr>
            <th>Rank</th><th>PV on Left and Right</th><th>Award (US $)</th><th>Condition <br> Sponsored on Left and Right</th>
        </tr>
    </thead>
    <tbody>
        <tr><td>Star 1</td><td style="text-align: center">500</td><td style="text-align: center">100</td><td style="text-align: center">Diamond </td></tr>
        <tr><td>Star 2</td><td style="text-align: center">1000</td><td style="text-align: center">200</td><td style="text-align: center">Star 1 </td></tr>
        <tr><td>Star 3</td><td style="text-align: center">2000</td><td style="text-align: center">500</td><td style="text-align: center">Star 2 </td></tr>
        <tr><td>Star 4</td><td style="text-align: center">5000</td><td style="text-align: center">1500</td><td style="text-align: center">Star 3</td></tr>
        <tr><td>Star 5</td><td style="text-align: center">10000</td><td style="text-align: center">3000</td><td style="text-align: center">Star 4</td></tr>
        <tr><td>Star 6</td><td style="text-align: center">15000</td><td style="text-align: center">6000</td><td style="text-align: center">Star 5</td></tr>
    </tbody>
</table>
    </div>
</div></p>
<h2>Incentives</h2>
<p>The company shall from time to time have promotional awards to encourage exiting members to increase effort in promoting this programme.</p>
<p>
    Read the detailed opportunity presentation <?= Html::a('here',['/training/default/index']) ?> and/or <?= Html::a("register", !empty($getreq->get('sponsor'))?Url::to(['/site/join', 'sponsor' => $getreq->get('sponsor')]):Url::to(['/site/signup'])) ?> now.
</p>
</div>
</div>
