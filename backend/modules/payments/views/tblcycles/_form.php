<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Tblcycles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblcycles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'member')->textInput() ?>

    <?= $form->field($model, 'memberFrom')->textInput() ?>

    <?= $form->field($model, 'lft')->textInput() ?>

    <?= $form->field($model, 'rgt')->textInput() ?>

    <?= $form->field($model, 'earnDate')->textInput() ?>

    <?= $form->field($model, 'trxDate')->textInput() ?>

    <?= $form->field($model, 'trxBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
