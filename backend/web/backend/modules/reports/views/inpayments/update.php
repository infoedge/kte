<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\reports\models\Inpayments */

$this->title = 'Update Inpayments: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Inpayments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="inpayments-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
