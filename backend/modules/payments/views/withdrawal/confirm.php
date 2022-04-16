<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Tblwithdrawal */

$this->title = Yii::t('app', 'Confirm Withdrawal');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pending List'), 'url' => ['pendinglist']];
$this->params['breadcrumbs'][] = Yii::t('app', $this->title);
?>
<div class="tblwithdrawal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_1', [
        'model' => $model,
    ]) ?>

</div>
