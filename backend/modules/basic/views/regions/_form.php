<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Regions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="regions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'RegionName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CountryId')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
