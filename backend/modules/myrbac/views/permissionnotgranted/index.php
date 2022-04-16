<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use backend\modules\myrbac\assets\MyrbacAsset;

$assets=MyrbacAsset::register($this);

$this->title='Login Required';
?>


<p style="align:center">
    <?= Html::a(Html::img($assets->baseUrl .'/images/LoginRequired4.jpg', ['alt' => 'Login Required'],['style'=>'align:center']),['/site/login']) ?>
</p>
