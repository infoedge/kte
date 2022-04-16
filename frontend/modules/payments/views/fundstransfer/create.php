<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblfundstransfer */

$this->title = Yii::t('app', 'Funds Transfer');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wallet'), 'url' => ['/dashboard/wallet/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblfundstransfer-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <h4><span class="redtitle">Note: Transfers attract a <?= $memberDetails->getAppConstant('commissionOnFundsTransfer')  ?>% transaction fee </span></h4>
    <br>
<div class="row">
    <div class="col-sm-9">
    <?= $this->render('_form_2', [
        'model' => $model,
    ]) ?>
    <h3>Listed Funds Transfers</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'fundsTrxCode',
            //'memberFrom',
            'amount',
            'dateGen',
            'memberTo',
            //'fundsRcvCode',
            'dateAccepted',
            //'recordBy',
            //'recordDate',
            //'changedby',
            //'changedDate',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    <div class="col-md-2 pull-right stats">
        <?php $form = ActiveForm::begin(); ?>   
            <h3>Wallet</h3>
            
            <?= Html::a(Yii::t('app', 'Back to Wallet'), ['/dashboard/wallet/index'], ['class' => 'btn btn-success btn-block']) ?><br>.
        
        <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
