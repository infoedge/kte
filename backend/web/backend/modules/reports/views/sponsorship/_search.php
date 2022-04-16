<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\SponsorshipSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sponsorship-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'membershipNo') ?>

    <?= $form->field($model, 'parent') ?>

    <?php // echo $form->field($model, 'lft') ?>

    <?php // echo $form->field($model, 'rgt') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'sponsor') ?>

    <?php // echo $form->field($model, 'level') ?>

    <?php // echo $form->field($model, 'Rank') ?>

    <?php // echo $form->field($model, 'prefPosition') ?>

    <?php // echo $form->field($model, 'prefix') ?>

    <?php // echo $form->field($model, 'RecordBy') ?>

    <?php // echo $form->field($model, 'RecordDate') ?>

    <?php // echo $form->field($model, 'ChangedBy') ?>

    <?php // echo $form->field($model, 'ChangedDate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
