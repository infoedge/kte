<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \yii\helpers\ArrayHelper;

use backend\modules\payments\models\Sponsorship;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Inpayments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inpayments-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member')->dropDownList(ArrayHelper::map(Sponsorship::find()->all(),'member','FullNameMembershipNoAndMemberNo'),['prompt'=>'Select a Member']) ?>

    
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Confirm'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
