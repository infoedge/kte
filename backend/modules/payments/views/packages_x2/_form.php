<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Packages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="packages-form">

    <?php $form = ActiveForm::begin(); ?>
<div class="row">
    <div class="col-sm-4">
    <?= $form->field($model, 'packName')->textInput(['maxlength' => true]) ?>
        </div>
    <div class="col-sm-4">
    <?= $form->field($model, 'regPack')->textInput() ?>
            </div>
    <div class="col-sm-4">
    <?= $form->field($model, 'updPack')->textInput() ?>
    </div>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
