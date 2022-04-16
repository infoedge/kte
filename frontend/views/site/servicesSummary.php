<?php

use yii\helpers\Html;
use yii\helpers\Url;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$this->title = 'Services Summary';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor)?$this->params['breadcrumbs'][] = "Your Referrer: ".$refmodel->memberName." - Member No: ".$refmodel->sponsor:'';
$getreq = Yii::$app->request;
?>
<div clsss="site-services">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>By <?= Html::a("joining us ", !empty($getreq->get('sponsor'))?Url::to(['/site/join', 'sponsor' => $getreq->get('sponsor')]):Url::to(['/site/signup'])) ?> you are becoming part of a community ready to better their lives in Personal and Economic grounds.
        Remember in our platform, we add value by allowing members to empower themselves and gain a competitive edge in their Lives, Education, Careers and also garner new horizons to improving their lives and lives of other people they interact with.
        Our training programs cut across all sectors and they have proven to be hugely beneficial to those willing to go through the material when uploaded.</p>
    <p>
        By following our simple concept of Learn, Share, Earn, you have an opportunity to <?= Html::a('earn additional income',['site/opportunity']) ?> daily, weekly and monthly by simply helping in expanding the community.
        We have two packages;
    </p>
    <p>Gold Package of 25$ and Diamond Package of 50$ 
</p><p> Diamond package has more training areas and higher earning potential from the affiliate program when you introduce other members than a Gold Package.
    You are at liberty to choose which Package to join with, and later upgrade where applicable, by paying the package difference. 
<div class ="row">
<div class="table-responsive">
    
    <div class="col-xs-12" id="pack-desc">
<table  class="table table-hover table-striped w-auto">
    <thead>
        <tr>
            <th scope="col" >TRAINING SERVICES</th>
            <th scope="col" class="text-center">GOLD</th>
            <th scope="col" class="text-center">DIAMOND</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'entrepreneurship']) ?>"> 1. Practical Steps to Entrepreneurship</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'networkmarketing']) ?>">2. Network Marketing.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'socialmediamarketing']) ?>">3. Social Media Marketing.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'jobsearchingskills']) ?>">4. Job Searching Skills.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'maximizingonespotential']) ?>">5. Maximizing Ones Potential.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'peaceeducation']) ?>">6. Peace Education.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'healthandfitness']) ?>">7. Health and Fitness trainings.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'cryptocurrency']) ?>">8. Cryptocurrency,</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td>   
        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'forextrading']) ?>">9. Forex Trading.</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'onlinebusiness']) ?>">10. Available Online Business Opportunities.</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td> 
        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'teambuilding']) ?>">11. Team Building.</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td> 
        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['site/services', '#'=>'relationshipsandparenting']) ?>">12. Relationships and Parenting.</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td> 
        </tr>
    </tbody>
</table>
        </div>
        </div>
</div>
<div class="row">

<p>
    Read the  <?= Html::a('opportunity overview',['site/opportunity']) ?> and/or <?= Html::a("join us", !empty($getreq->get('sponsor'))?Url::to(['/site/join', 'sponsor' => $getreq->get('sponsor')]):Url::to(['/site/signup'])) ?> now.
</p>
</div>
</div>
