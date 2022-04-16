<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use dosamigos\datepicker\DatePicker;

use frontend\modules\payments\models\Paymenttypes;
use frontend\modules\payments\models\Paymethods;
use frontend\modules\payments\models\Sponsorship;
use frontend\modules\payments\models\Packages;
use frontend\modules\payments\models\People;
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
            <?= $form->field($model, 'package')->dropDownList(ArrayHelper::map(Packages::find()->all(), 'id', 'packName'),['prompt'=> '--Select preferred Package--','disabled'=>'disabled']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'pMethod')->dropDownList(ArrayHelper::map(Paymethods::find()->where(['id'=>[5]])->all(), 'id', 'methodName'),['prompt'=>'--Select payment method--']) ?>
        </div>
        
        <div class="col-sm-3">
            <?= $form->field($model, 'trxNo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'amount')->textInput(['disabled'=>'diabled']) ?>
        </div>
        
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
	<?php Pjax::end() ?>
    <?php ActiveForm::end(); ?>

</div>
