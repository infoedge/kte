<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\basic\models\Countries;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\CFlags */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cflags-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-4">
    <?= $form->field($model, 'c_id')->dropDownList(ArrayHelper::map(Countries::find()->all(),'id','Name'),['prompt'=>'-Select Country-']) ?>
    </div>
    <div class="col-sm-4">
    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>
</div>
    <div class="col-sm-4">
    <?= $form->field($model, 'countryFlag')->textInput(['maxlength' => true]) ?>
    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
