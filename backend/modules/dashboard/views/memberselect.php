<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\dashboard\models\Memberselect */
/* @var $form ActiveForm */
?>
<div class="memberselect">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'member') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- memberselect -->
