<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\video\models\VideolistSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="videolist-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'vTopic') ?>

    <?= $form->field($model, 'videoType') ?>

    <?= $form->field($model, 'vid') ?>

    <?= $form->field($model, 'vDesc') ?>

    <?php // echo $form->field($model, 'vName') ?>

    <?php // echo $form->field($model, 'order') ?>

    <?php // echo $form->field($model, 'fromDate') ?>

    <?php // echo $form->field($model, 'toDate') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
