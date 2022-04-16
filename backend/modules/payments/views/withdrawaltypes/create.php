<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Withdrawaltypes */

$this->title = Yii::t('app', 'Wallet Withdrawal Types');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payament Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="withdrawaltypes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h3>Listed Types</h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'typeName',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
