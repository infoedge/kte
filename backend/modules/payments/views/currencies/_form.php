<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\TblCurrencies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-currencies-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-4">
    <?= $form->field($model, 'currencyName')->textInput(['maxlength' => true]) ?>
     </div>
    <div class="col-sm-4">
    <?= $form->field($model, 'ShortName')->textInput(['maxlength' => true]) ?>
        </div>
    <div class="col-sm-4">
    <?= $form->field($model, 'Symbol')->textInput(['maxlength' => true]) ?>
    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
