<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\AuthAssignment */

$this->title = Yii::t('app', 'Assign Roles and Permissions');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'RBAC Switchboard'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-assignment-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
