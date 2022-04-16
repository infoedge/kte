<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Tblmatching */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblmatching-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member')->textInput() ?>

    <?= $form->field($model, 'rank')->textInput() ?>

    <?= $form->field($model, 'memberFrom')->textInput() ?>

    <?= $form->field($model, 'relLevel')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'trxToWalletBy')->textInput() ?>

    <?= $form->field($model, 'trxToWalletDate')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
