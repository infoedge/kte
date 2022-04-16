<?php
$this->title = "Training";

use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-training">

    <h1 ><?= $this->title ?></h1>
    <div class="row">
        <div class col-md-10>
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
            <th scope="row"><a href="<?= Url::to(['/training/entreprenuer/index']) ?>"> 1. Practical Steps to Entrepreneurship</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/training/networking/index']) ?>">2. Network Marketing.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/training/socialmedia/index']) ?>">3. Social Media Marketing.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/training/jobsearch/index']) ?>">4. Job Searching Skills.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/training/maxpotential/index']) ?>">5. Maximizing Ones Potential.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/site/services', '#'=>'peaceeducation']) ?>">6. Peace Education.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/training/healthfit/index']) ?>">7. Health and Fitness trainings.</a></th>
            <td class="text-center">YES</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/training/cryptocurrency/index']) ?>">8. Cryptocurrency,</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td>   
        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/training/forex/index']) ?>">9. Forex Trading.</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td>

        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/training/onlinebusiness/index']) ?>">10. Available Online Business Opportunities.</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td> 
        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/site/services', '#'=>'teambuilding']) ?>">11. Team Building.</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td> 
        </tr>
        <tr>
            <th scope="row"><a href="<?= Url::to(['/training/parenting/index']) ?>">12. Relationships and Parenting.</a></th>
            <td class="text-center">NO</td>
            <td class="text-center">YES</td> 
        </tr>
    </tbody>
</table>
        </div>
        </div>
        <div class="col-md-2 pull-right stats">

        </div>
    </div>
</div>


