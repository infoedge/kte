<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use backend\modules\basic\models\Countries;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Dialcodes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dialcodes-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-3">
    <?= $form->field($model, 'c_id')->dropDownList(ArrayHelper::map(Countries::find()->all(),'id','Name')) ?>
    </div>
    <div class="col-sm-3">
    <?= $form->field($model, 'countryCode')->textInput() ?>
        </div>
    <div class="col-sm-3">
    <?= $form->field($model, 'exitCode')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-3">
    <?= $form->field($model, 'trunkCode')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
