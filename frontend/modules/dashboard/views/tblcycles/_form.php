<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Tblcycles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblcycles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member')->textInput() ?>

    <?= $form->field($model, 'memberFrom')->textInput() ?>

    <?= $form->field($model, 'lft')->textInput() ?>

    <?= $form->field($model, 'rgt')->textInput() ?>

    <?= $form->field($model, 'earnDate')->textInput() ?>

    <?= $form->field($model, 'cyclesValid')->textInput() ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trxDate')->textInput() ?>

    <?= $form->field($model, 'trxBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
