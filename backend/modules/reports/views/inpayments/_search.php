<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\InpaymentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inpayments-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'package') ?>

    <?= $form->field($model, 'ptype') ?>

    <?= $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'pdate') ?>

    <?php // echo $form->field($model, 'pMethod') ?>

    <?php // echo $form->field($model, 'transactionNo') ?>

    <?php // echo $form->field($model, 'confirmed') ?>

    <?php // echo $form->field($model, 'confirmBy') ?>

    <?php // echo $form->field($model, 'confirmDate') ?>

    <?php // echo $form->field($model, 'comments') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
