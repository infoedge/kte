<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\AuthItem */

$this->title = Yii::t('app', 'Add '.$model->itemname);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'RBAC Switchboard'), 'url' => ['default/index']];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h3><?= Yii::t('app',$model->itemname.'s Already Listed') ?></h3>
        
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            //'type',
            'description:ntext',
            'rule_name',
            'data',
            //'created_at',
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
