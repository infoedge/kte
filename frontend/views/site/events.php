<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Events';
$this->params['breadcrumbs'][] = $this->title;
!empty($refmodel->sponsor)?$this->params['breadcrumbs'][] = "Your Referrer: ".$refmodel->memberName." - Member No: ".$refmodel->sponsor:'';
?>
<div class="site-faq">
    <div class="row">
        <h1>Events</h1>
    </div>
</div>