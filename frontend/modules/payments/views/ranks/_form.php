<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Ranks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ranks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rankName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'advBonus')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
