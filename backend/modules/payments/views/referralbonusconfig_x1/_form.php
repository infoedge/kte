<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use backend\modules\payments\models\Packages;
use backend\modules\payments\models\Ranks;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Referralbonusconfig */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="referralbonusconfig-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-3">
    <?= $form->field($model, 'package')->dropDownList(ArrayHelper::map(Packages::find()->all(), 'id', 'packName'),['prompt'=> '--Select Package--']) ?>
        </div>
        <div class="col-sm-3">
    <?= $form->field($model, 'rank')->dropDownList(ArrayHelper::map(Ranks::find()->all(), 'id', 'rankName'),['prompt'=> '--Select Rank--']) ?>
        </div>
        <div class="col-sm-3">
    <?= $form->field($model, 'level')->textInput() ?>
        </div>
        <div class="col-sm-3">
    <?= $form->field($model, 'amount')->textInput() ?>
        </div>
    </div>
</div>
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
