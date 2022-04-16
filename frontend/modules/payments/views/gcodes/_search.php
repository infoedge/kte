<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\TblgcodesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblgcodes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'code') ?>

    <?= $form->field($model, 'memberGen') ?>

    <?= $form->field($model, 'dateGen') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'retrivedate') ?>

    <?php // echo $form->field($model, 'retrieveBy') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <?php // echo $form->field($model, 'changedBy') ?>

    <?php // echo $form->field($model, 'changedDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
