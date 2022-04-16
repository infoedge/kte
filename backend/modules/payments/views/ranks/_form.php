<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Ranks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ranks-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class=""col-sm-6>
    <?= $form->field($model, 'rankName')->textInput(['maxlength' => true]) ?>
    </div>
     <div class=""col-sm-6>
    <?= $form->field($model, 'advBonus')->textInput() ?>
     </div>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
