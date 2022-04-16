<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\PeopleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="people-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'titleId') ?>

    <?= $form->field($model, 'surname') ?>

    <?= $form->field($model, 'otherNames') ?>

    <?= $form->field($model, 'firstName') ?>

    <?php // echo $form->field($model, 'identityNo') ?>

    <?php // echo $form->field($model, 'IdentityType') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'phoneNo') ?>

    <?php // echo $form->field($model, 'recordBy') ?>

    <?php // echo $form->field($model, 'recordDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
