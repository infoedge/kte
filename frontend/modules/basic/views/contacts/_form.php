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
    <div class="row">
        <?php foreach($contacts as $model){ ?>
        <div class="col-sm-4">
            <?= $form->field($model, 'PersonId')->dropDownList(ArrayHelper::map(People::find()->all(), 'id', 'FullName'), ['prompt' => '--Select Person--']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'ContactType')->dropDownList(ArrayHelper::map(Contacttypes::find()->all(), 'id', 'contacttypeName'), ['prompt' => '--Select Contact Type--']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'ContactsValue')->textInput(['maxlength' => true]) ?>
        </div>
        <?php } ?>
        <!--<?= $form->field($model, 'recordBy')->textInput() ?>
    
        <?= $form->field($model, 'recordDate')->textInput() ?>
    
        <?= $form->field($model, 'changedBy')->textInput() ?>
    
        <?= $form->field($model, 'changedDate')->textInput() ?>-->
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
