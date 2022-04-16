<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Membershiphistory */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membershiphistory-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'memberId')->textInput() ?>

    <?= $form->field($model, 'packageId')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'rank')->textInput() ?>

    <?= $form->field($model, 'statusEndDate')->textInput() ?>

    <?= $form->field($model, 'expiryDate')->textInput() ?>

    <?= $form->field($model, 'dateStart')->textInput() ?>

    <?= $form->field($model, 'dateEnd')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
