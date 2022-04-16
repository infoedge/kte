<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\WalletSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wallet-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'fromTable') ?>

    <?= $form->field($model, 'trxDate') ?>

    <?= $form->field($model, 'trxMethod') ?>

    <?php // echo $form->field($model, 'trxId') ?>

    <?php // echo $form->field($model, 'trxDir') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
