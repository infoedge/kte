<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\ReferralbonusconfigSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referralbonusconfig-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'package') ?>

    <?= $form->field($model, 'rank') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
