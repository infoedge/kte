<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Ipytrxstatus */

$this->title = Yii::t('app', 'Add iPay Transaction Statuses');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ipytrxstatuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ipytrxstatus-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

    <hr>
    <h3>Listed Statuses</h3>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'code',
            'name',
            'description',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                ],
            ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
