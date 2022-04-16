<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
?>
<div class="ipay-status">
<h1>Payment Status</h1>
<div class="row">
    <div class="col-sm-12">
        <h3>The status of your payment is:<?= $statusArr['status'] ?></h3>
        <?php $form = ActiveForm::begin(); ?>
        
        <p><?= $statusArr['statusId'] ==2? Html::submitButton(Html::encode('Finish Registration'),['name'=>'btn1','value'=>'1','class'=>'btn btn-warning btn-lg']):'' ?></p>
        <p><?= $statusArr['statusId'] !==2? Html::submitButton(Html::encode('Confirm Status'),['name'=>'btn1','value'=>'2','class'=>'btn btn-primary btn-lg']):'' ?></p>
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>