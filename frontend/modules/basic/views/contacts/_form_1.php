<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\People;
use common\models\Contacttypes;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Contacts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contacts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php foreach ($contacts as $m => $model) { ?>
        <div class="row">
            <!--<div class="col-sm-4">
            <?= $form->field($model, "[$m]PersonId")->dropDownList(ArrayHelper::map(People::find()->all(), 'id', 'FullName'), ['prompt' => '--Select Person--', 'disabled' => 'disabled'])->label(null) ?>
            </div>-->
            <div class="col-sm-4">
                <?= $form->field($model, "[$m]ContactType")->label($m>0?false:null)->dropDownList(ArrayHelper::map(Contacttypes::find()->all(), 'id', 'contacttypeName'), ['prompt' => '--Select Contact Type--']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, "[$m]ContactsValue")->label($m>0?false:null)->textInput(['maxlength' => true]) ?>
            </div>

            <!--<?= $form->field($model, 'recordBy')->textInput() ?>
        
            <?= $form->field($model, 'recordDate')->textInput() ?>
        
            <?= $form->field($model, 'changedBy')->textInput() ?>
        
            <?= $form->field($model, 'changedDate')->textInput() ?>-->

        </div>
    <?php } ?>
    <div class="row">
        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary','name'=>'btn','value'=>1]) ?>
            <?= Html::submitButton(Yii::t('app', 'Cancel'), ['class' =>  'btn btn-success','name'=>'btn','value'=>2]) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
