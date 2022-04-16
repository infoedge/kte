<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use dosamigos\datepicker\DatePicker;

use frontend\modules\payments\models\Paymenttypes;
use frontend\modules\payments\models\Paymethods;
use frontend\modules\payments\models\Sponsorship;
use frontend\modules\payments\models\Packages;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Inpayments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inpayments-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'member')->dropDownList(ArrayHelper::map(Sponsorship::find()->all(), 'member', 'membershipNo'), ['disabled' => 'disabled']) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'ptype')->dropDownList(ArrayHelper::map(Paymenttypes::find()->all(), 'id', 'ptypeName'), ['disabled' => 'disabled']) ?>
        </div>



        <div class="col-sm-3">
            <!--<?= $form->field($model, 'pdate')->textInput() ?>-->
            <?=
            $form->field($model, 'pdate')->widget(
                    DatePicker::className(), [
                // inline too, not bad
                'inline' => false,
                // modify template for custom rendering
                //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                'clientOptions' => [
                    'autoclose' => true,
                    'format' => 'yyyy-mm-dd',
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'pMethod')->dropDownList(ArrayHelper::map(Paymethods::find()->all(), 'id', 'methodName')) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'package')->dropDownList(ArrayHelper::map(Packages::find()->all(), 'id', 'packName'),['prompt'=>'--Choose Package--','onChange'=>
                        '$.post("index.php?r=payments/inpayments/get-pack-value&package='.'$this->val()")'
                ]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'transactionNo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'amount')->textInput() ?>
        </div>
        <div class="col-sm-4">


            <?= $form->field($model, 'comments')->textarea(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
