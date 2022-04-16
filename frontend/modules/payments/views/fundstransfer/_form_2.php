<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblfundstransfer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblfundstransfer-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php Pjax::begin() ?>

    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'sendMemberNo')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'amount')->textInput() ?>
        </div>

    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Transfer'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php Pjax::end() ?>
    <?php ActiveForm::end(); ?>

</div>
