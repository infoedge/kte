<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use dosamigos\datepicker\DatePicker;
use frontend\modules\basic\models\Titles;
use frontend\modules\basic\models\Contacttypes;
use frontend\modules\basic\models\Identitytypes;
use frontend\modules\basic\models\Countries;
use frontend\modules\basic\models\Cities;

/* @var $this yii\web\View */
/* @var $model frontend\modules\basic\models\People */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="people-form">

<?php $form = ActiveForm::begin(); ?>
    <?php Pjax::begin() ?>
    <div class="row">
        <div class="col-sm-2">
<?= $form->field($model, 'titleId')->dropdownList(ArrayHelper::map(Titles::find()->all(), 'id', 'title'), ['prompt' => 'Enter Title']) ?>
        </div>
        <div class="col-sm-3">
<?= $form->field($model, 'firstName')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">  
<?= $form->field($model, 'otherNames')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
<?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
        </div>


    </div>
    <div class="row">
        <div class="col-sm-3">
<?= $form->field($model, 'gender')->dropdownList(['1' => 'Male', '2' => 'Female'], ['prompt' => 'Enter Gender']) ?>
        </div>
        <div class="col-sm-3">
            <!--<?= $form->field($model, 'dob')->textInput() ?>-->
<?=
$form->field($model, 'dob')->widget(
        DatePicker::className(), [
    // inline too, not bad
    'inline' => false,
    // modify template for custom rendering
    //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
    'clientOptions' => [
        'autoclose' => true,
        'format' => 'yyyy-mm-dd',
        'endDate' => Yii::$app->useful->addDateInterval(date('Y-m-d H:i:s'), (-18 * 365), 2),
    ]
]);
?>
        </div>

        <div class="col-sm-3">
                
<?= $form->field($model, 'nationality')->dropdownList(ArrayHelper::map($ctry = Countries::find()->all(), 'id', 'Name'), ['prompt' => 'Enter National Of']) ?>
            
        </div>
        <div class="col-sm-3">
<?= $form->field($model, 'city')->dropdownList(ArrayHelper::map(Cities::find()->where(['country' => $model->nationality])->all(), 'id', 'city'), ['prompt' => '--City/ Town--']) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-4">
<?= $form->field($model, 'identityNo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-4">
<?= $form->field($model, 'IdentityType')->dropdownList(ArrayHelper::map(Identitytypes::find()->all(), 'id', 'idTypeName'), ['prompt' => 'Enter ID Type']) ?>
        </div>
        <div class="col-sm-4">
            <div class="col-sm-2">
                <br><br>
                <span id="flag">.</span>
            </div>
            <div class="col-sm-10">
<?= $form->field($model, 'phoneNo')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2">
<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Submit') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success btn-block' : 'btn btn-primary btn-block', 'name' => 'btn', 'value' => 1]) ?>
        </div>

        <div class="col-sm-2">
            <!--<?= Html::button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-success btn-block', 'name' => 'btn', 'value' => 2, 'url' => $backlink]) ?>-->
<?= Html::a("Cancel", [$backlink], ['class' => 'btn btn-success btn-block']); ?>    
        </div>
    </div>
<?php Pjax::end(); ?>
    <?php ActiveForm::end(); ?>

</div>
