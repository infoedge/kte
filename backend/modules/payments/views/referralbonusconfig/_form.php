<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\modules\payments\models\Packages;
use backend\modules\payments\models\Ranks;
use backend\modules\payments\models\Paymenttypes;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Referralbonusconfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referralbonusconfig-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
                <div class="col-sm-2">
            <?= $form->field($model, 'trxType')->dropDownList(ArrayHelper::map(Paymenttypes::find()->all(), 'id', 'ptypeName'), ['prompt' => '--Select trx Type--']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'sPackage')->dropDownList(ArrayHelper::map(Packages::find()->all(), 'id', 'packName'), ['prompt' => '--Select Package--']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'sRank')->dropDownList(ArrayHelper::map(Ranks::find()->all(), 'id', 'rankName'), ['prompt' => '--Select Rank--']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'mPackage')->dropDownList(ArrayHelper::map(Packages::find()->all(), 'id', 'packName'), ['prompt' => '--Select Package--']) ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'level')->textInput() ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($model, 'amount')->textInput() ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
