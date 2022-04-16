<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\TblpointsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblpoints-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sponsor') ?>

    <?= $form->field($model, 'memberFrom') ?>

    <?= $form->field($model, 'bonusType') ?>

    <?= $form->field($model, 'points') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'cashInDate') ?>

    <?php // echo $form->field($model, 'CashInBy') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
