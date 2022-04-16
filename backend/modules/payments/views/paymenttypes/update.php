<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Paymenttypes */

$this->title = Yii::t('app', 'Update Payment Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => 'Add Payment Types', 'url' => ['create']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="paymenttypes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
