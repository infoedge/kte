<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\payments\models\People;
use backend\modules\payments\models\Withdrawaltypes;
use backend\modules\payments\models\Withdrawalstatus;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Tblwithdrawal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblwithdrawal-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div  class="col-sm-3">
            <?= $form->field($model, 'member')->dropDownList(ArrayHelper::map(People::find()->all(), 'id', 'FullName'), ['disabled' => 'disabled']) ?>
        </div>
        <div  class="col-sm-2">
            <?= $form->field($model, 'withdrawalType')->dropDownList(ArrayHelper::map(Withdrawaltypes::find()->all(), 'id', 'typeName'), ['disabled' => 'disabled']) ?>
        </div>
        <div  class="col-sm-3">
            <?= $form->field($model, 'accountNo')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>
        </div>
        <div  class="col-sm-3">
            <?= $form->field($model, 'withdrawalCode')->textInput(['maxlength' => true, 'disabled' => 'disabled']) ?>
        </div>
        <div  class="col-sm-1">
            <?= $form->field($model, 'amount')->textInput(['disabled' => 'disabled']) ?> 
        </div>
        
    </div>
    <hr>
    <div class="form-group">
        <div class="row">
            <div  class="col-sm-offset-2 col-sm-4">
                <?= $form->field($model, 'status')->radioList(ArrayHelper::map(Withdrawalstatus::find()->all(), 'id', 'statusName')) ?>
            </div>
            <div class="col-sm-2">
                <br><br>
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                <?= Html::submitButton(Yii::t('app', 'Cancel'), ['class' => 'btn btn-success', 'name'=>'btn','value'=>2]) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
