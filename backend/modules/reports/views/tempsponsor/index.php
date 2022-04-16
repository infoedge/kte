<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reports\models\TempsponsorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Prospects List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tempsponsor-index">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'ProspectsEmail',
            'value'=>'member0.email',
            ],
            ['attribute'=>'ProspectsName',
            'value'=>'member0.people.FullName',],
            [
                'attribute'=>'SponsorsName',
            'value'=>'sponsor0.member0.FullName',],
            [
                'attribute'=>'sponsor',
                'label'=>'SponsorsMemberNo',
                //'attribute'=>'sponsor',
                ],
            [
                'attribute'=>'SponsorsEmail',
            'value'=>'sponsor0.member0.user.email',],
            [
                'label'=>'Prospect Status',
                'attribute'=>'pstatus',
                'value'=>'prospectStatus',],
            //'membershipNo',
            //'parent',
            //'lft',
            //'parMethod',
            //'RecordBy',
            //'RecordDate',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
