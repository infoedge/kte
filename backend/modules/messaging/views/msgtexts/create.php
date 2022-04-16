<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\messaging\models\Tblmsgtexts */

$this->title = Yii::t('app', 'Create Message Texts');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblmsgtexts-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>Formulate message texts here</p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
