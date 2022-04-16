<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Tblgcodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblgcodes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memberGen')->textInput() ?>

    <?= $form->field($model, 'dateGen')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'walletId')->textInput() ?>

    <?= $form->field($model, 'recipientEmail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'retrieveDate')->textInput() ?>

    <?= $form->field($model, 'retrieveBy')->textInput() ?>

    <?= $form->field($model, 'expiryDate')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <?= $form->field($model, 'changedBy')->textInput() ?>

    <?= $form->field($model, 'changedDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
