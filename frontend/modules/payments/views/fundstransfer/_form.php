<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblfundstransfer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblfundstransfer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fundsTrxCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'memberFrom')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'dateGen')->textInput() ?>

    <?= $form->field($model, 'memberTo')->textInput() ?>

    <?= $form->field($model, 'fundsRcvCode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dateAccepted')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <?= $form->field($model, 'changedby')->textInput() ?>

    <?= $form->field($model, 'changedDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
