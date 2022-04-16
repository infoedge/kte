<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Sponsorship */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sponsorship-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'parent')->textInput() ?>

    <?= $form->field($model, 'lft')->textInput() ?>

    <?= $form->field($model, 'rgt')->textInput() ?>

    <?= $form->field($model, 'sponsor')->textInput() ?>

    <?= $form->field($model, 'level')->textInput() ?>

    <?= $form->field($model, 'Rank')->textInput() ?>

    <?= $form->field($model, 'RecordBy')->textInput() ?>

    <?= $form->field($model, 'RecordDate')->textInput() ?>

    <?= $form->field($model, 'ChangedBy')->textInput() ?>

    <?= $form->field($model, 'ChangedDate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
