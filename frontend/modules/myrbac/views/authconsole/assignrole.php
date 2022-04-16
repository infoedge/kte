<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\Auth */
/* @var $form ActiveForm */
?>
<div class="permissionorrole">

    <?php $form = ActiveForm::begin(); ?>
    <h2>Add Permission</h2>
    <p>This form will create permissions</p>
        <?= $form->field($model, 'permissionOrRole')->label($model->typeTitle) ?>
        
        <?= $form->field($model, 'description') ?>
        
        
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- permissionorrole -->
