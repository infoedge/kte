<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Compensationunits */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compensationunits-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'UnitName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unitShortform')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
