<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Admin Switchboard'
?>
<h1>Admin Switchboard</h1>
<div class="row">
    <div class="col-lg-4">
        <h2>General</h2>
        <?= Html::a(Yii::t('app', 'Payment Configuration'), ['/payments/default/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
<?= Html::a(Yii::t('app', 'Reports'), ['/reports/default/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
<?= Html::a(Yii::t('app', 'Manage Authorization'), ['/myrbac/default/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
<?= Html::a(Yii::t('app', 'Member Dashboard'), ['/dashboard/default/memberselect'], ['class' => 'btn btn-primary btn-block']) ?></br>
<?= Html::a(Yii::t('app', 'Messaging'), ['/messaging/default/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
<?= Html::a(Yii::t('app', 'Training Videos'), ['/video/default/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
<?= Html::a(Yii::t('app', 'Basic Settings'), ['/basic/default/index'], ['class' => 'btn btn-primary btn-block']) ?></br>

    </div>
    <div class="col-lg-4">
        <h2>Currency</h2>
        <?= Html::a(Yii::t('app', 'Exchange Rates'), ['/payments/exchange-rates/create'], ['class' => 'btn btn-warning btn-block']) ?></br>
        <?= Html::a(Yii::t('app', 'Currencies'), ['/payments/currencies/create'], ['class' => 'btn btn-warning btn-block']) ?></br>
    </div>
    <div class="col-lg-4">

    </div>
</div>

<div class="row">
    <?php
    //Get current coin exchange rates
    //$myrates = Yii::$app->coinPayments->cp_api_call('rates');
    //print_r($myrates);
    //echo '1 USD = '.$myrates['result']['USD']['rate_btc'].' BTC';
    ?>
</div>
