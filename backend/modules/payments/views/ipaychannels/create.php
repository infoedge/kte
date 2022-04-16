<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Ipychannels */

$this->title = Yii::t('app', 'Add IPay Channels');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ipychannels'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipychannels-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <hr>
    <h3>Listed Channels</h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'channelName',
            'symbol',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
