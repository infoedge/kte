<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Appconstants */

$this->title = Yii::t('app', 'Update Appconstants: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Appconstants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="appconstants-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_3', [
        'model' => $model,
    ]) ?>

</div>
