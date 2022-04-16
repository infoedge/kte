<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\Auth */
/* @var $form ActiveForm */
$this->title=Yii::t('app','Add Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'RBAC Switchboard'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="assignarole">

    <?php $form = ActiveForm::begin(); ?>
    <h2>Add Role</h2>
        <?= $form->field($model, 'permissionOrRole')->label('Role') ?>
        <?= $form->field($model, 'description') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    <h3><?= Yii::t('app','Roles Already Listed') ?></h3>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                
                ],

            'name',
            //'type',
            'description:ntext',
            'rule_name',
            'data',
            //'created_at',
            //'updated_at',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' =>'{update}',
                'header'=> 'Action',
                'buttons'=>[
                    'update'=> function($url,$model){
                            \yii\helpers\Url::remember();
                            return Html::a( '<span class="glyphicon glyphicon-icon-pencil" id="recommendicon" title="Update" ></span>',  ['update','Id'=>$model->name,'titleType'=>$model->titleType]);
                    },
                            
                ],
            ],
        ],
    ]); ?>
</div><!-- assignarole -->
