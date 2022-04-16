<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Inpayments */

$this->title = Yii::t('app', 'Awaiting Confirmation');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inpayments'), 'url' => ['default']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inpayments-awaitapproval">

    <h1><?= Html::encode($this->title) ?></h1>
    
    
    <p>
    <h4>Your payment confirmation is still pending</h4> 
    <?= Html::a('Refresh', ['awaitapproval'],['class'=>'btn btn-success'])  ?>
    </p>

</div>
