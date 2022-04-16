<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Ipytrxstatus */

$this->title = Yii::t('app', 'Create Ipytrxstatus');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ipytrxstatuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipytrxstatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
