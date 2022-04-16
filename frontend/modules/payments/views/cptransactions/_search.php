<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\CptransactionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cptransactions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'memberId') ?>

    <?= $form->field($model, 'trxId') ?>

    <?= $form->field($model, 'packId') ?>

    <?= $form->field($model, 'dateStart') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'bc_trx_id') ?>

    <?php // echo $form->field($model, 'trxNo') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'statusDate') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'dest_tag') ?>

    <?php // echo $form->field($model, 'confirms_needed') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
