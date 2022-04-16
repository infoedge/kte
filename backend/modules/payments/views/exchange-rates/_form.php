<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use yii\helpers\ArrayHelper;
use backend\modules\payments\models\TblCurrencies;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\TblExchangeRates */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-exchange-rates-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($model, 'currency')->dropDownlist(ArrayHelper::map(TblCurrencies::find()->all(),'id','currencyName')) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'rate')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <!--<?= $form->field($model, 'fromDate')->textInput() ?>-->
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
        <div class="col-sm-3">
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
