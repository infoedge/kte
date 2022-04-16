<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor)?$this->params['breadcrumbs'][] = "Your Referrer: ".$refmodel->memberName." - Member No: ".$refmodel->sponsor:'';
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register:</p>
    <p><span style="color:red">Request the person who sent you this link to send you their Member #. <i>This is the Sponsor's ID</i></span></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="col-sm-6">
                    <?= $form->field($model, 'sponsor')->textInput(['autofocus' => true,'title'=>'Please ask your Referer for their Membership Number or to send you a joining link']) ?>
                </div>
                
            </div>
            <div class="row">
                <div class="col-sm-12">
                <?= $form->field($model, 'email') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <?= $form->field($model, 'email_repeat') ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                <?= $form->field($model, 'password')->passwordInput() ?>
                </div>

                <div class="col-sm-6">
                    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
                </div>
                <p><strong>Note:</strong>A password must be at least 8 characters long, start with a letter, and also contain numbers & special characters like '?*+&-%$^£%'</p>
            </div>
                <div class="form-group">
                    Clicking here below means that you agree with our <?= Html::a('Terms and Conditions', ['termsandconditions'])?><br>
                    <?= Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
