<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Inpayments */

$this->title = Yii::t('app', 'Confirm Member Registration');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inpayments-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_1', [
        'model' => $model,
    ]) ?>

</div>
