<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\genealogy\models\Statuses */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="statuses-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'Status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <?= Html::resetButton(Yii::t('app', 'Clear'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
