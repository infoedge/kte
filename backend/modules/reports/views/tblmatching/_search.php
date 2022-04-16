<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\TblmatchingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblmatching-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'rank') ?>

    <?= $form->field($model, 'memberFrom') ?>

    <?= $form->field($model, 'relLevel') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'trxToWalletBy') ?>

    <?php // echo $form->field($model, 'trxToWalletDate') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
