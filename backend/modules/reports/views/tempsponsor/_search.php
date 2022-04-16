<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\TempsponsorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tempsponsor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'sponsor') ?>

    <?= $form->field($model, 'parent') ?>

    <?= $form->field($model, 'lft') ?>

    <?php // echo $form->field($model, 'parMethod') ?>

    <?php // echo $form->field($model, 'RecordBy') ?>

    <?php // echo $form->field($model, 'RecordDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
