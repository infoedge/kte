<?php
$this->title = "Subscription";

use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-subscribe">
    
        <h1 ><?= $this->title ?></h1>
        <h3>Your current active membership <?= $membership->status==1?'ended on':' ends on' ?> <?= $membership->expiryDate ?></h3>
        <h4>To <?= $membership->status==1?'re-activate ':' Extend ' ?> your account <?= $membership->status==1?' ':' activation ' ?> click button below</h4>
        <?= Html::a($membership->status==1?'Re-activate ':' Extend',Url::to(['/payments/inpayments/reactivate','member'=>$membership->memberId,'ptype'=>2,'package'=>$membership->packId]),['class'=>'btn btn-success']);?>
                
</div>
