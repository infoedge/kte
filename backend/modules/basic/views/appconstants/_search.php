<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\AppconstantsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appconstants-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'constantName') ?>

    <?= $form->field($model, 'constantValue') ?>

    <?= $form->field($model, 'fromDate') ?>

    <?= $form->field($model, 'toDate') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
