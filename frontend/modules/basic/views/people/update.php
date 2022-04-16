<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\People */

$this->title = Yii::t('app', 'Update Personal Details for ', [
    'modelClass' => 'People',
]) . $model->FullName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Peoples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="people-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'backlink' => $backlink,
    ]) ?>
    
</div>
