<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use dosamigos\datepicker\DatePicker;

use frontend\modules\payments\models\Paymenttypes;
use frontend\modules\payments\models\Paymethods;
use frontend\modules\payments\models\Sponsorship;
use frontend\modules\payments\models\Packages;
use frontend\modules\basic\models\People;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Inpayments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inpayments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php Pjax::begin() ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'member')->dropDownList(ArrayHelper::map(People::find()->all(), 'id', 'FullName'), ['disabled' => 'disabled']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'ptype')->dropDownList(ArrayHelper::map(Paymenttypes::find()->all(), 'id', 'ptypeName'), ['disabled' => 'disabled']) ?>
        </div>
        



    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'package')->dropDownList(ArrayHelper::map(Packages::find()->all(), 'id', 'packName'),['prompt'=> '--Select preferred Package--']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'pMethod')->dropDownList(ArrayHelper::map(Paymethods::find()->where(['id'=>[5]])->all(), 'id', 'methodName'),['prompt'=>'--Select payment method--']) ?>
        </div>
        
        <div class="col-sm-3">
            <?= $form->field($model, 'transactionNo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'amount')->textInput(['disabled'=>'disabled']) ?>
        </div>
        
    </div>
    <div class="row">
        
        
    </div>
    <div class="row">
        <div id ="myrates" class="col-md-offset-3>
            <?php
                //Get current coin exchange rates
                $myrates = Yii::$app->coinPayments->cp_api_call('rates');
                //print_r($myrates);
                //echo '1 USD = '.$myrates['result']['USD']['rate_btc'].' BTC';   
            ?>
        </div>
        <div id="myresult">
            
        </div>
        
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <div id="mybitcoin" class="col-sm-offset-4">
        <?= Html::submitButton(Yii::t('app', 'Start Bitcoin Transaction'), ['class' => 'btn btn-primary', 'name'=>'btn1', 'value'=>2]) ?>
        </div>
    </div>
        
	<?php Pjax::end() ?>
    <?php ActiveForm::end(); ?>

</div>
