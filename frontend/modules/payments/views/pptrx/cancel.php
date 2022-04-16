<?php

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Paypal Transaction Cancelled');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['inpayments/packregistration', 'member' => Yii::$app->user->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pptrx-cancel">
    <div class="row">
        <div class="col-sm-offset-3">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app','Back to Inpayments') ,Url::to(['/payments/inpayments/packregistration']),['class'=>'btn btn-primary']) ?>.
            </p>
        </div>
    </div>
</div>