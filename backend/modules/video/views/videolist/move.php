<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\video\models\Videolist */

$this->title = Yii::t('app', 'Re-Order Videolist');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Videolists'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="videolist-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_2', [
        'model' => $model,
    ]) ?>

</div>
