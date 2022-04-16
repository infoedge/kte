<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Packregistration */
/* @var $form ActiveForm */
?>
<div class="payments-packregistration">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'member') ?>
        <?= $form->field($model, 'ptype') ?>
        <?= $form->field($model, 'amount') ?>
        <?= $form->field($model, 'pdate') ?>
        <?= $form->field($model, 'package') ?>
        <?= $form->field($model, 'trxNo') ?>
        <?= $form->field($model, 'comments') ?>
        <?= $form->field($model, 'pMethod') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- payments-packregistration -->
