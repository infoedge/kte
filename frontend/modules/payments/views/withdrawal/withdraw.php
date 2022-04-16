<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblwithdrawal */

$this->title = Yii::t('app', 'Funds Withdrawal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wallet'), 'url' => ['dashboard/wallet/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblwithdrawal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
