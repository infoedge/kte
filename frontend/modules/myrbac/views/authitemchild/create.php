<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\AuthItemChild */

$this->title = Yii::t('app', 'Roles/Permissions Hierarchy');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'RBAC Switchboard'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
