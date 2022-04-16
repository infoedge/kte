<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\dashboard\models\Tblcycles */

$this->title = Yii::t('app', 'Create Tblcycles');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblcycles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblcycles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
