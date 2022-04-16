<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Tblcycleearnings */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblcycleearnings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member')->textInput() ?>

    <?= $form->field($model, 'earnDate')->textInput() ?>

    <?= $form->field($model, 'cycles')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'calcMatchBonus')->textInput() ?>

    <?= $form->field($model, 'trxToWalletDate')->textInput() ?>

    <?= $form->field($model, 'trxToWalletBy')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
