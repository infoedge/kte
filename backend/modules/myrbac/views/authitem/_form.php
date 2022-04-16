<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-6">
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-6">
    <!--<?= $form->field($model, 'type')->textInput() ?>-->

    
    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>
    </div>
</div>
<div class="row">
     
    <div class="col-sm-6">
    <?= $form->field($model, 'rule_name')->textInput(['maxlength' => true]) ?>
        </div>
    <div class="col-sm-6">
    <?= $form->field($model, 'data')->textInput() ?>
    </div>
</div>
    <!--<?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?> -->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
