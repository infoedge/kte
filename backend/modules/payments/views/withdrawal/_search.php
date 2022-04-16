<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\TblwithdrawalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblwithdrawal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'withdrawalType') ?>

    <?= $form->field($model, 'accountNo') ?>

    <?= $form->field($model, 'withdrawalCode') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'requestBy') ?>

    <?php // echo $form->field($model, 'requestDate') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'approvedBy') ?>

    <?php // echo $form->field($model, 'approvedDate') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
