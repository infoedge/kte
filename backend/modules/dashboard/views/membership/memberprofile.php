<?php
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Select Member'), 'url' => ['/dashboard/default/memberselect']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/dashboard/default/index','memberId'=>Yii::$app->session['memberId'] ]];

$this->title = "Member Profile";

use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;
?>
<div class="dashboard-membership-memberprofile">

    <h1 ><?= $this->title ?></h1>
    <div class="row">
        <div class col-md-10>

        </div>
        <div class="col-md-2 pull-right stats">

        </div>
    </div>
</div>


