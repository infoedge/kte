<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\TblcycleearningsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblcycleearnings-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'earnDate') ?>

    <?= $form->field($model, 'cycles') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'calcMatchBonus') ?>

    <?php // echo $form->field($model, 'trxToWalletDate') ?>

    <?php // echo $form->field($model, 'trxToWalletBy') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
