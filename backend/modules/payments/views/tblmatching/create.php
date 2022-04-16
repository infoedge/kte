<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Tblmatching */

$this->title = Yii::t('app', 'Create Tblmatching');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblmatchings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblmatching-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
