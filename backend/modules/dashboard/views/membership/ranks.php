<?php
$this->title = "Ranks Achieved";

use yii\helpers\Html;
use \yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Training'), 'url' => ['/dashboard/membership/training']];
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Practical Steps to Entrerenuership'), 'url' => ['/training/entreprenuer/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-membership-ranks">

    <h1 ><?= $this->title ?></h1>
    <div class="row">
        <div class="col-md-9">
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'memberId',
            //'packageId',
            //'status',
            [
                'attribute'=>'Rank',
                'value'=>'rank0.rankName',
                ],
            //'statusEndDate',
            //'expiryDate',
            [
                'attribute'=>'Date Achieved',
                'value'=>'dateStart',
                ],
            //'dateEnd',
            //'recordBy',
            //'recordDate',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
        </div>
        <div class="col-md-2 pull-right stats">

        </div>
    </div>
</div>


