<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use backend\modules\messaging\models\Tblmsgtypes;

/* @var $this yii\web\View */
/* @var $model backend\modules\messaging\models\Tblmsgtexts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblmsgtexts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'msgType')->dropDownList(ArrayHelper::map(Tblmsgtypes::find()->all(), 'id', 'typeName'),['prompt'=>'- Select Message Type -']) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'msgText')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
