<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Appconstants */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appconstants-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-sm-3">
            <?= $form->field($model, 'constantName')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'constantValue')->textInput() ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'constantUnits')->dropDownList(ArrayHelper::map(\common\models\Constantunits::find()->all(), 'id', 'unitName'),['prompt'=>'Select the Units']) ?>
        </div>
        <div class="col-sm-1">
            <?= Html::img('images/plussign.png',['url'=>'constantunits/create','id'=>'addContantUnits','value'=>'1','data-toggle'=>"popover", 'title'=>"Click to add another Unit Type"])  ?>
        </div> 
        <div class="col-sm-2">
            <!--<?= $form->field($model, 'fromDate')->textInput() ?>-->
            <?=
            $form->field($model, 'fromDate')->widget(
                    DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                //'endDate'=>date_add(date_create(date('Y-m-d H:i:s')),date_interval_create_from_date_string("-18 Years"))
                ]
            ]);
            ?>
            

        </div>
        <div class="col-sm-2">
            <!--<?= $form->field($model, 'toDate')->textInput() ?>-->
            <?=
            $form->field($model, 'toDate')->widget(
                    DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                //'endDate'=>date_add(date_create(date('Y-m-d H:i:s')),date_interval_create_from_date_string("-18 Years"))
                ]
            ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
