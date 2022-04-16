<?php
$this->title = "Upgrade";

use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-upgrade">
        <h1 ><?= $this->title ?></h1>
        <?='<h3>Your Current Package is '. $membership->packageName.'</h3>' ?> 
        <?= ($membership->packId==1) ?  '<p>To Upgrade, click the button below</p>'. Html::a('Upgrade to Diamond',Url::to(['/payments/inpayments/upgrade/','member'=>$membership->memberId,'ptype'=>3,'packId'=>$membership->packId+1]),['class'=>'btn btn-success'])
                :'<h3>No upgrade possible<h3>'
                ?>
</div>