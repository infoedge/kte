<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Cptransactions */

$this->title = Yii::t('app', 'Create Cptransactions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cptransactions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cptransactions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
