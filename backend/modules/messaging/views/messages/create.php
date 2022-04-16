<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\messaging\models\Tblmessages */

$this->title = Yii::t('app', 'Create Tblmessages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tblmessages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblmessages-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
