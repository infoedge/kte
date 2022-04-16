<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use \backend\modules\myrbac\models\AuthItem;
use \backend\modules\myrbac\models\User;

/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'item_name')->dropDownList(ArrayHelper::map(AuthItem::find()->all(),'name','name'),['prompt'=>'--Select a Role Or Permission--','title'=>'Select User to be assigened the Role or permission selected']) ?>

    <?= $form->field($model, 'user_id')->dropDownList(ArrayHelper::map(User::find()->all(),'id','username'),['prompt'=>'--Select a User --','title'=>'Select User to be assigened the Role or permission selected']) ?>

    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
