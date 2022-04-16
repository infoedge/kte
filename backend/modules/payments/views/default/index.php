<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = Yii::t('app', 'Payment Config');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Switchboard'), 'url' => ['/switchboard/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payments-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-sm-4">
            <h2>Manage</h2>
            <?= Html::a(Yii::t('app', 'Confirm Payments'), ['inpayments/checkpay'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Confirm Withdrawals'), ['withdrawal/pendinglist'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Withdrawals List'), ['withdrawal/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Confirm Membership Details'), ['inpayments/confirm-member-details'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Member Dashboard'), ['/dashboard/default/memberselect'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <!--<?= Html::a(Yii::t('app', 'Audit Sponsor Points'), ['tblpoints/tblpoints-audit'], ['class' => 'btn btn-primary btn-block']) ?></br>-->
            <?= Html::a(Yii::t('app', 'Confirm All Registrations'), ['/payments/inpayments/confirm-all-registrations'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Manage Gift Codes'), ['/payments/gcodes/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
            
            
        </div>
        <div class="col-sm-4">
            <h2>Set Up</h2>
            <?= Html::a(Yii::t('app', 'Compensation Types'), ['compensationtypes/create'], ['class' => 'btn btn-success btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Recipient Types'), ['recipient-types/create'], ['class' => 'btn btn-success btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Manage Ranks'), ['ranks/create'], ['class' => 'btn btn-success btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Manage Packages'), ['packages/create'], ['class' => 'btn btn-success btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Transaction Types'), ['pointtrxtypes/create'], ['class' => 'btn btn-success btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Wallet Withdrawal Types'), ['withdrawaltypes/create'], ['class' => 'btn btn-success btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Bonus Types'), ['bonustypes/create'], ['class' => 'btn btn-success btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'withdrawal Statuses'), ['withdrawalstatus/create'], ['class' => 'btn btn-success btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'iPay Transaction Statuses'), ['ipytrxstatus/create'], ['class' => 'btn btn-success btn-block']) ?></br>
            
        </div>
        <div class="col-sm-4">
            <h2>Configuration</h2>
            <?= Html::a(Yii::t('app', 'Package Configuration'), ['packconfig/create'], ['class' => 'btn btn-warning btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Referral Bonus Config'), ['referralbonusconfig/create'], ['class' => 'btn btn-warning btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Manage Pay Types'), ['paymenttypes/create'], ['class' => 'btn btn-warning btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Manage Payment Methods'), ['paymethods/create'], ['class' => 'btn btn-warning btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Application Constants'), ['/basic/appconstants/index'], ['class' => 'btn btn-warning btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Constant Units'), ['/basic/constantunits/create'], ['class' => 'btn btn-warning btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Manage Sponsorship Points'), ['tblpoints/index'], ['class' => 'btn btn-warning btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Manage Binary Points'), ['tblcycles/index'], ['class' => 'btn btn-warning btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Manage iPay Channels'), ['ipaychannels/create'], ['class' => 'btn btn-warning btn-block']) ?></br>
        </div>
    </div>
</div>
