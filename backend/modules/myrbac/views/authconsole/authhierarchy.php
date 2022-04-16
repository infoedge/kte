<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use backend\modules\myrbac\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\AuthHierarchy */
/* @var $form ActiveForm */
$this->title=Yii::t('app','Parent Child Hierarchy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'RBAC Switchboard'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="authhierarchy">

    <?php $form = ActiveForm::begin(); ?>
    <h2><?= Html::encode($this->title) ?></h2>
        <?= $form->field($model, 'parent')->dropDownList(ArrayHelper::map(AuthItem::find()->all(),'name','name'),['prompt'=>'--Select an Item--']) ?>
        <?= $form->field($model, 'children')->dropDownList(ArrayHelper::map(AuthItem::find()->all(),'name','name'),['prompt'=>'--Select an Item--']) ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- authhierarchy -->
