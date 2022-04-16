<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Appconstants */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appconstants-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'constantName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'constantValue')->textInput() ?>

    <?= $form->field($model, 'fromDate')->textInput() ?>

    <?= $form->field($model, 'toDate')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
