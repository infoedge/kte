<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\Auth */
/* @var $form ActiveForm */
?>
<div class="assignrole">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'permissionOrRole') ?>
        <?= $form->field($model, 'description') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- assignrole -->
