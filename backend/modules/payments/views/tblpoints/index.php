<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\payments\models\TblpointsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Sponsorship Points');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblpoints-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--<?= Html::a(Yii::t('app', 'Add Sponsorship Points'), ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'Sponsor',
                'value'=>'sponsor0.sponsorship.membershipNo',
                ],
            
            [
                'attribute'=>'Sponsored',
                'value'=>'memberFrom0.sponsorship.membershipNo',
                ],
            'bonusType',
            'points',
            //'recordDate',
            //'recordBy',
            //'cashInDate',
            //'CashInBy',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
