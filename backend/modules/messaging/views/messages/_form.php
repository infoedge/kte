<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\messaging\models\Tblmessages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblmessages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'msgId')->textInput() ?>

    <?= $form->field($model, 'sentBy')->textInput() ?>

    <?= $form->field($model, 'sentTo')->textInput() ?>

    <?= $form->field($model, 'dateSent')->textInput() ?>

    <?= $form->field($model, 'confirmMsgSentDate')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
