<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\People */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="people-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'titleId')->textInput() ?>

    <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'otherNames')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'identityNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'IdentityType')->textInput() ?>

    <?= $form->field($model, 'nationality')->textInput() ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'phoneNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
