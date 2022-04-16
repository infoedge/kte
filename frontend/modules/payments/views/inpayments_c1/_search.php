<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\InpaymentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inpayments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'ptype') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'pdate') ?>

    <?php // echo $form->field($model, 'pMethod') ?>

    <?php // echo $form->field($model, 'transactionNo') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
