<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\TblfundstransferSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblfundstransfer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fundsTrxCode') ?>

    <?= $form->field($model, 'memberFrom') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'dateGen') ?>

    <?php // echo $form->field($model, 'memberTo') ?>

    <?php // echo $form->field($model, 'fundsRcvCode') ?>

    <?php // echo $form->field($model, 'dateAccepted') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <?php // echo $form->field($model, 'changedby') ?>

    <?php // echo $form->field($model, 'changedDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
