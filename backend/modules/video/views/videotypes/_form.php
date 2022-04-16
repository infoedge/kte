<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\modules\video\models\Videotypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="videotypes-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
    <?= $form->field($model, 'typeName')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
    <?= $form->field($model, 'urlPrefix')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
