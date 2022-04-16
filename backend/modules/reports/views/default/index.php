<?php
use yii\helpers\Html;

$this->title = 'Reports';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Switchboard'), 'url' => ['/switchboard/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reports-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-4">
    `       <?= Html::a(Yii::t('app', 'All Members List'), ['sponsorship/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'All Member Stats'), ['sponsorship/show-stats'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Prospects List '), ['tempsponsor/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Daily Inpayments'), ['inpayments/showdaily'], ['class' => 'btn btn-primary btn-block']) ?></br>
            

        </div>
    </div>
</div>
