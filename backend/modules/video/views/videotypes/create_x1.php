<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\video\models\Videotypes */

$this->title = Yii::t('app', 'Add Video Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Videos'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videotypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h3>Listed Video Types</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'typeName',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
