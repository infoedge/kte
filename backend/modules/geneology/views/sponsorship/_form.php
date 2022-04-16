<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\genealogy\models\People;
use backend\modules\genealogy\models\Statuses;

/* @var $this yii\web\View */
/* @var $model backend\modules\genealogy\models\Sponsorship */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sponsorship-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'member')->dropDownList(ArrayHelper::map(People::find()
                    ->where(['In','id',Yii::$app->memberdetails->getProspectiveMembers()])->all(), 'id', 'FullNameAndEmail'),['prompt'=>'Select Member']) ?>
        </div>
        <div class="col-sm-1">
            <?= Html::img('images/common/plussign.png', ['url' => 'basic/people/create', 'id' => 'addPerson', 'value' => '1', 'data-toggle' => "popover", 'title' => "Click to add a new member\'s details", 'disabled'=>$model->isNewRecord?null:'disabled']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'status')->dropDownList(ArrayHelper::map(Statuses::find()->all(), 'id', 'Status')) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'membershipNo')->textInput(['disabled'=>'disabled']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'sponsor')->dropDownList(ArrayHelper::map(People::find()
                    ->where(['In','id',Yii::$app->memberdetails->getMembersList()])->all(), 'id', 'FullNameAndEmail'),['prompt'=>'Select Sponsor']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'parent')->dropDownList(ArrayHelper::map(People::find()
                    ->where(['In','id',Yii::$app->memberdetails->getMembersList()])->all(), 'id', 'FullNameAndEmail'),['prompt'=>'Select Parent']) ?>
        </div>
    
        
         <!--<div class="col-sm-3">
            <?= $form->field($model, 'level')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'Rank')->textInput(['maxlength' => true]) ?>

           <?= $form->field($model, 'RecordBy')->textInput() ?>
        
            <?= $form->field($model, 'RecordDate')->textInput() ?>
        
            <?= $form->field($model, 'ChangedBy')->textInput() ?>
        
            <?= $form->field($model, 'ChangedDate')->textInput() ?>-->
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
