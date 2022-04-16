<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\video\models\Videolist */

$this->title = Yii::t('app', 'Add to Video List');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Videos'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videolist-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'vName',
            'vTopic',
            'videoType',
            'vid',
            'vDesc',
            
            //'order',
            //'fromDate',
            //'toDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
