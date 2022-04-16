<?php
use yii\helpers\Html;


$this->title = Yii::t('app', 'Basic Information');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Switchboard'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basic-default-index">
    <h1><?= $this->title ?></h1>
    <div class="col-sm-4">
        <h2>Data Entry</h2>
        <?= Html::a(Yii::t('app','Personal Data'),['people/create'],['class'=>'btn btn-success btn-block']) ?></br>
    </div>
    <div class="col-sm-4">
        <h2></h2>
        
    </div>
    <div class="col-sm-4">
        <h2>Settings</h2>
        <?= Html::a(Yii::t('app','Contact Types'),['contacttypes/create'],['class'=>'btn btn-success btn-block']) ?></br>
        <?= Html::a(Yii::t('app','Titles'),['titles/create'],['class'=>'btn btn-success btn-block']) ?></br>
        <?= Html::a(Yii::t('app','National Of'),['countries/create'],['class'=>'btn btn-success btn-block']) ?></br>
        <?= Html::a(Yii::t('app','Identity Types'),['identitytypes/create'],['class'=>'btn btn-success btn-block']) ?></br>
    </div>
</div>
