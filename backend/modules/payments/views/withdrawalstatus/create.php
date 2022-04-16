<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Withdrawalstatus */

$this->title = Yii::t('app', 'Add Withdrawal Statuses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payments'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawalstatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h3>Listed Withdrawal Statuses</h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'statusName',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
