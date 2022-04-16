<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use frontend\modules\basic\models\Cities;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\People */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="people-form">

    <?php $form = ActiveForm::begin(); ?>

    

    <h4><span class="highlight">Member Name:</span> <?= $model->FullName ?></h4>

    <h4><span class="highlight"> National Of :</span> <?= $model->nationality0->Name ?></h4>
    
    <h4><span class="highlight"><?= $model->identityType->idTypeName ?> #:</span> <?= $model->identityNo ?></h4>
    
    <h4><span class="highlight">Date of Birth:</span> <?= Yii::$app->formatter->asDate($model->dob) ?></h4>
    
    <h4><span class="highlight">Gender:</span> <?= $model->gender==1?'Male':'Female' ?></h4>
    
    <h4><span class="highlight">E-mail:</span> <?= $model->user->email ?></h4>
    <div class="row">
        <div class="col-md-6">   
    
    <?= $form->field($model, 'city')->dropdownList(ArrayHelper::map(Cities::find()->where(['country'=>$model->nationality])->all(),'id','city'),['prompt'=>'--City/ Town--']) ?>
        </div>
        <div class="col-md-6">
    <?= $form->field($model, 'phoneNo')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
