<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Tblpoints */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblpoints-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sponsor')->textInput() ?>

    <?= $form->field($model, 'memberFrom')->textInput() ?>

    <?= $form->field($model, 'bonusType')->textInput() ?>

    <?= $form->field($model, 'relLevel')->textInput() ?>

    <?= $form->field($model, 'points')->textInput() ?>

    <?= $form->field($model, 'recordDate')->textInput() ?>

    <?= $form->field($model, 'recordBy')->textInput() ?>

    <?= $form->field($model, 'cashInDate')->textInput() ?>

    <?= $form->field($model, 'CashInBy')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
