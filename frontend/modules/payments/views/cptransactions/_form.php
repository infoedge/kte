<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use \frontend\modules\payments\models\People;
use frontend\modules\payments\models\Paymenttypes;
use frontend\modules\payments\models\Packages;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Cptransactions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cptransactions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'memberId')->dropDownList(ArrayHelper::map(People::find()->where(['id'=>$model->memberId])->all(),'id','FullName')) ?>

    <?= $form->field($model, 'trxId')->dropDownList(ArrayHelper::map(Paymenttypes::find()->all(),'id','ptypeName')) ?>

    <?= $form->field($model, 'packId')->dropDownList(ArrayHelper::map(Packages::find()->all(),'id','packName')) ?>

    <?= $form->field($model, 'dateStart')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <!--<?= $form->field($model, 'bc_trx_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trxNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusDate')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dest_tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirms_needed')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Start Transaction'), ['class' => 'btn btn-success']) ?>
    </div>
    
</div>
