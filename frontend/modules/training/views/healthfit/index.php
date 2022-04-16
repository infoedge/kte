<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title= 'Health and Fitness Training';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<p>
<ol>
    <li><?=Html::a('Wellness And Individual Behaviour',['/training/healthfit/heal002'])?></li>
    <li><?=Html::a('Alcoholism And Drugs Abuse',['/training/healthfit/heal001'])?></li>
    
</ol>
</p>
