<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Constantunits */

$this->title = Yii::t('app', 'Add Constant Units');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Constantunits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="constantunits-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <hr>
    <h3>Listed Units</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'unitName',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}'],
        ],
    ]); ?>
</div>
