<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Compensationtypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="compensationtypes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'compTypeName')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
