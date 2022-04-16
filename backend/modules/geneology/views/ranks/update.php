<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\genealogy\models\Ranks */

$this->title = Yii::t('app', 'Update Ranks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manage Ranks'), 'url' => ['create']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ranks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
