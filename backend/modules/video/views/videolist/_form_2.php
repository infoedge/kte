<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

use backend\modules\video\models\Videotopics;
use backend\modules\video\models\Videotypes;

/* @var $this yii\web\View */
/* @var $model backend\modules\video\models\Videolist */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="videolist-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'vTopic')->dropDownList(ArrayHelper::map(Videotopics::find()->all(),'id','topicName'),['prompt'=>'-Select Video Topic-','disabled'=>'disabled']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'vName')->textInput(['maxlength' => true,'disabled'=>'disabled']) ?>
        </div>
        <div class="col-sm-2">
    <?= $form->field($model, 'vid')->textInput(['maxlength' => true,'disabled'=>'disabled']) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'vDesc')->textarea(['maxlength' => true,'disabled'=>'disabled']) ?>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-1">
            <?= $form->field($model, 'order')->textInput() ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'videoType')->dropDownList(ArrayHelper::map(Videotypes::find()->all(),'id','typeName'),['disabled'=>'disabled']) ?>
        </div>
        <div class="col-sm-2">
            <!--<?= $form->field($model, 'fromDate')->textInput(['disabled'=>'disabled']) ?>-->
            <?= $form->field($model, 'fromDate')->widget(
                    DatePicker::className(), [
                        // inline too, not bad
                         'inline' => false,

                         // modify template for custom rendering
                        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',

                        ]
                ]);?>
        </div>
        <div class="col-sm-2">
            <!--<?= $form->field($model, 'toDate')->textInput() ?>-->
            <?= $form->field($model, 'toDate')->widget(
                    DatePicker::className(), [
                        // inline too, not bad
                         'inline' => false,

                         // modify template for custom rendering
                        //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                        'clientOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',

                        ]
                ]);?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
