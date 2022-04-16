<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\MembershiphistorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="membershiphistory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'memberId') ?>

    <?= $form->field($model, 'packageId') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'rank') ?>

    <?php // echo $form->field($model, 'statusEndDate') ?>

    <?php // echo $form->field($model, 'expiryDate') ?>

    <?php // echo $form->field($model, 'dateStart') ?>

    <?php // echo $form->field($model, 'dateEnd') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
