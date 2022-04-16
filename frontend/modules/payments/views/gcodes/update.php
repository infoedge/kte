<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblgcodes */

$this->title = Yii::t('app', 'Add Recipient Email');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wallet'), 'url' => ['/dashboard/wallet/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Generate Gift Code'), 'url' => ['/payments/gcodes/create']];
$this->params['breadcrumbs'][] = $this->title;
//$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="tblgcodes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'myarr' => $myarr,
    ]) ?>

</div>
