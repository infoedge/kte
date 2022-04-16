<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Inpayments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inpayments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member')->textInput() ?>

    <?= $form->field($model, 'package')->textInput() ?>

    <?= $form->field($model, 'ptype')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'pdate')->textInput() ?>

    <?= $form->field($model, 'pMethod')->textInput() ?>

    <?= $form->field($model, 'transactionNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirmed')->textInput() ?>

    <?= $form->field($model, 'confirmBy')->textInput() ?>

    <?= $form->field($model, 'confirmDate')->textInput() ?>

    <?= $form->field($model, 'comments')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
