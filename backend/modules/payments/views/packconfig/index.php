<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\payments\models\PackconfigSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Packconfigs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="packconfig-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Packconfig'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'packId',
            'trxType',
            'amount',
            'recordBy',
            //'recordDate',
            //'changedBy',
            //'changeDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
