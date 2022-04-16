<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor)?$this->params['breadcrumbs'][] = "Your Referrer: ".$refmodel->memberName." - Member No: ".$refmodel->sponsor:'';
?>
<h1>About</h1>