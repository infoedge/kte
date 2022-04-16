<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblgcodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblgcodes-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class='row' >
        <div class ='col-sm-2' >
            <?= $form->field($model, 'code')->textInput(['maxlength' => true,'disabled'=>'disabled']) ?>
        </div>
        <div class ='col-sm-3' >
            <?= $form->field($model, 'packconfigId')->dropDownList(ArrayHelper::map($myarr,'id','item'),['prompt'=>'--Choose Type of Gift Code--','disabled'=>'disabled']) ?>
        </div>
        <div class ='col-sm-4' >
            <?= $form->field($model, 'recipientEmail')->textInput() ?>
        </div>
        
    </div>
   <!-- <?= $form->field($model, 'memberGen')->textInput() ?>

    <?= $form->field($model, 'dateGen')->textInput() ?>

    

    <?= $form->field($model, 'retrieveDate')->textInput() ?>

    <?= $form->field($model, 'retrieveBy')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <?= $form->field($model, 'changedBy')->textInput() ?> 

    <?= $form->field($model, 'changedDate')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Send Email'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
