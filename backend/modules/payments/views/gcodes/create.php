<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Tblgcodes */

$this->title = Yii::t('app', 'Create Tblgcodes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblgcodes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblgcodes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
