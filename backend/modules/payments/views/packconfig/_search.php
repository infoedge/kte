<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\PackconfigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packconfig-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'packId') ?>

    <?= $form->field($model, 'trxType') ?>

    <?= $form->field($model, 'amount') ?>
    
    <?= $form->field($model,  'sponsorPoints') ?>
    
    <?= $form->field($model,  'cyclePoints') ?>

    <?= $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <?php // echo $form->field($model, 'changedBy') ?>

    <?php // echo $form->field($model, 'changeDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
