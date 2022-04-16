<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Tblpoints */

$this->title = Yii::t('app', 'Create Tblpoints');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblpoints'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblpoints-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
