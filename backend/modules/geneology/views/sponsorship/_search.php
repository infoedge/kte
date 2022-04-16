<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\genealogy\models\SponsorshipSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sponsorship-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'child') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'sponsorshipNo') ?>

    <?= $form->field($model, 'parent') ?>

    <?php // echo $form->field($model, 'sponsor') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'Rank') ?>

    <?php // echo $form->field($model, 'RecordBy') ?>

    <?php // echo $form->field($model, 'RecordDate') ?>

    <?php // echo $form->field($model, 'ChangedBy') ?>

    <?php // echo $form->field($model, 'ChangedDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
