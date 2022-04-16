<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Withdrawaltypes */

$this->title = Yii::t('app', 'Update Withdrawal Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payament Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wallet Withdrawal Types'), 'url' => ['create']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="withdrawaltypes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
