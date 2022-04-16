<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Tblwithdrawal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblwithdrawal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member')->textInput() ?>

    <?= $form->field($model, 'withdrawalType')->textInput() ?>

    <?= $form->field($model, 'accountNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'withdrawalCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'requestBy')->textInput() ?>

    <?= $form->field($model, 'requestDate')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'approvedBy')->textInput() ?>

    <?= $form->field($model, 'approvedDate')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
