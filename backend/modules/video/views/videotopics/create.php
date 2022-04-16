<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\video\models\Videotopics */

$this->title = Yii::t('app', 'Add Video Topics');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training Videos'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="videotopics-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h3>Listed Video Topics</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'topicName',

            ['class' => 'yii\grid\ActionColumn',
                'template' =>'{update}',
                ],
        ],
    ]); ?>

</div>
