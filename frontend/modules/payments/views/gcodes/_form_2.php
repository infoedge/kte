<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\modules\payments\models\Packconfig;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblgcodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblgcodes-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <!--<?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>-->

    <!--<?= $form->field($model, 'memberGen')->textInput() ?>-->

    <!--<?= $form->field($model, 'dateGen')->textInput() ?>-->
    <div class="col-sm-4">
    <?= $form->field($model, 'recipientEmail')->textInput() ?>
        <p><strong><span style="color:red">Note: </span>An email will be sent to the recipient containing the Gift code and with instructions on how to use it. 
                <br><span style="color:red">Leave 'Recipient Email' blank if you DO NOT want Gift Code email sent</span>
                <br></strong></p>
    </div>
    <div class="col-sm-4">
    <?= $form->field($model, 'packconfigId')->dropDownList(ArrayHelper::map($myarr,'id','item'),['prompt'=>'--Choose Type of Gift Code--']) ?>
    </div>
    <div class="col-sm-4">
    <?= $form->field($model, 'amount')->hiddenInput()->label('') ?>
    </div>
    <br>.
    <br>.
    <br>.
    
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Generate'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
