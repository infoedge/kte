<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Titles */

$this->title = Yii::t('app', 'Titles');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Switchboard'), 'url' => ['/switchboard/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Basic Info'), 'url' => ['default/index']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Titles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="titles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h3>Already Listed Titles</h3>
    <?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}'],
        ],
    ]); ?>
</div>
