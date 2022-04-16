<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblwtpwd */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tblwtpwd-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-sm-4">
            <?= $form->field($model, 'pwd')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'pwd_repeat')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
