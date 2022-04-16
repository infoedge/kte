<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use frontend\modules\payments\models\Withdrawaltypes;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblwithdrawal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblwithdrawal-form">

    <?php $form = ActiveForm::begin(); ?>


    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'withdrawalType')->dropDownList(ArrayHelper::map(Withdrawaltypes::find()->all(),'id','typeName'),['prompt'=>'-Select withdraw to-']) ?>
        </div>
        <div class="col-sm-4">
    <?= $form->field($model, 'accountNo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
    <?= $form->field($model, 'amount')->textInput() ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Request'), ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Cancel'),['/dashboard/wallet/index'] ,['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
