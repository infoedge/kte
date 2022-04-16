<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Tblrankearnings */

$this->title = Yii::t('app', 'Create Tblrankearnings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblrankearnings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblrankearnings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
