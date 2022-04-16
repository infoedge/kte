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
<div class="row">
    <div class="col-sm-3">
    <?= $form->field($model, 'memberId')->dropDownList(ArrayHelper::map(People::find()->where(['id'=>$model->memberId])->all(),'id','FullName'),['disabled'=>'disabled']) ?>
    </div>
    <div class="col-sm-2">
    <?= $form->field($model, 'trxId')->dropDownList(ArrayHelper::map(Paymenttypes::find()->all(),'id','ptypeName'),['disabled'=>'disabled']) ?>
        </div>
    <div class="col-sm-2">
    <?= $form->field($model, 'packId')->dropDownList(ArrayHelper::map(Packages::find()->all(),'id','packName'),['disabled'=>'disabled']) ?>
</div>
    <div class="col-sm-3">
    <?= $form->field($model, 'dateStart')->textInput(['disabled'=>'disabled']) ?>
</div>
    <div class="col-sm-2">
    <?= $form->field($model, 'amount')->textInput(['disabled'=>'disabled']) ?>
</div>
</div>
    <!--<?= $form->field($model, 'bc_trx_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'trxNo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'statusDate')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dest_tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'confirms_needed')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Start Transaction'), ['class' => 'btn btn-success']) ?>
        <?= Html::submitButton(Yii::t('app', 'Cancel'), ['class' => 'btn btn-success','name'=>'btn','value'=>2]) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <div id="mybitcoinGold">
        
        <?php yii\bootstrap\ActiveForm::begin([
             'action'=>'https://www.coinpayments.net/index.php',
             'method'=>'post'

             ])?>
                <input type="hidden" name="cmd" value="_pay">
                <input type="hidden" name="reset" value="1">
                <input type="hidden" name="merchant" value="bf3f235bd068fb1ac6fd27d354bf0371">
                <input type="hidden" name="item_name" value="<?= $model->packageName.' Package' ?>">
                <input type="hidden" name="currency" value="USD">
                <input type="hidden" name="amountf" value="<?= Yii::$app->formatter->asDecimal($model->amount, 8) ?>">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="allow_quantity" value="0">
                <input type="hidden" name="want_shipping" value="0">
                <input type="hidden" name="allow_extra" value="0">
                <?= Html::submitButton(Yii::t('app', 'Get Bitcoin'), ['class' => 'btn btn-primary','id'=>'bcBtn1', 'name'=>'bcBtn1', 'value'=>2]) ?>
                
         <?php yii\bootstrap\ActiveForm::end() ?>
         <?php yii\bootstrap\ActiveForm::begin([
             'action'=>'https://www.coinpayments.net/index.php',
             'method'=>'post'

             ])?>
                <input type="hidden" name="cmd" value="create_transaction">
                <input type="hidden" name="reset" value="1">
                <input type="hidden" name="merchant" value="bf3f235bd068fb1ac6fd27d354bf0371">
                <input type="hidden" name="item_name" value="<?= $model->packageName.' Package' ?>">
                <input type="hidden" name="currency1" value="USD">
                <input type="hidden" name="currency2" value="BTC">
                <input type="hidden" name="amountf" value="<?= Yii::$app->formatter->asDecimal($model->amount, 8) ?>">
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="allow_quantity" value="0">
                <input type="hidden" name="want_shipping" value="0">
                <input type="hidden" name="allow_extra" value="0">
                <?= Html::submitButton(Yii::t('app', 'Get Bitcoin Auto'), ['class' => 'btn btn-warning','id'=>'bcBtn1', 'name'=>'bcBtn1', 'value'=>3]) ?>
                
         <?php yii\bootstrap\ActiveForm::end() ?>
    </div>

</div>
