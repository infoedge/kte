<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Placement */
/* @var $form ActiveForm */
?>
<div class="placement">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'sponsor') ?>
        <?= $form->field($model, 'parent') ?>
        <?= $form->field($model, 'pos') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- placement -->
