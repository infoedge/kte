<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\basic\models\Countries;
use backend\modules\basic\models\Cities;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Cities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-3">
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-sm-3">
    <?= $form->field($model, 'country')->dropDownList(ArrayHelper::map(Countries::find()->all(),'id','Name'),['prompt'=>'Select Country']) ?>
        </div>
    <div class="col-sm-3">
    <?= $form->field($model, 'area')->textInput() ?>
        </div>
    <div class="col-sm-3">
    <?= $form->field($model, 'geonameid')->textInput() ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
</div>
    <?php ActiveForm::end(); ?>

</div>
