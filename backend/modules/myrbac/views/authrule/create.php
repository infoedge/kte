<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\myrbac\models\AuthRule */

$this->title = Yii::t('app', 'Add Authorization Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'RBAC Switchboard'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-rule-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
