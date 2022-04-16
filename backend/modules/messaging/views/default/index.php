<?php

use yii\helpers\Html;

$this->title = "Messaging";

$this->params['breadcrumbs'][] = $this->title;        
?>
<div class="messaging-default-index">
    <h1><?= $this->title ?></h1>
    <div class="row">
        <div class ="col-sm-4">
            <?= Html::a(Yii::t('app', 'Message Texts'), ['msgtexts/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Message Sending List'), ['messages/index'], ['class' => 'btn btn-primary btn-block']) ?></br>
            <?= Html::a(Yii::t('app', 'Message Types'), ['msgtypes/create'], ['class' => 'btn btn-primary btn-block']) ?></br>
        </div>
        <div class ="col-sm-4">
            
        </div>
        <div class ="col-sm-4">
            
        </div>
    </div>
</div>
