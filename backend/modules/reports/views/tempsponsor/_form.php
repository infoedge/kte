<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Tempsponsor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tempsponsor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member')->textInput() ?>

    <?= $form->field($model, 'sponsor')->textInput() ?>

    <?= $form->field($model, 'parent')->textInput() ?>

    <?= $form->field($model, 'lft')->textInput() ?>

    <?= $form->field($model, 'parMethod')->textInput() ?>

    <?= $form->field($model, 'RecordBy')->textInput() ?>

    <?= $form->field($model, 'RecordDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
