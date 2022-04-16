<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\TblcyclesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblcycles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'member') ?>

    <?= $form->field($model, 'memberFrom') ?>

    <?= $form->field($model, 'lft') ?>

    <?= $form->field($model, 'rgt') ?>

    <?php // echo $form->field($model, 'earnDate') ?>

    <?php // echo $form->field($model, 'cyclesValid') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'trxDate') ?>

    <?php // echo $form->field($model, 'trxBy') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
