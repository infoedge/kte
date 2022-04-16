<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reports\models\SponsorshipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Members List';
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admin Switchboard'), 'url' => ['/switchboard/index']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reports'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponsorship-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [   'attribute'=>'memberName',
                'value'=>'member0.FullName',
                ],
            'membershipNo',
            'status0.Status',
            [   'label'=>'Side (of Parent)',
                'value'=>'position0',
                ],
            [   'label'=>'Sponsor Name',
                'value'=>'sponsor0.fullName',
                ],
            [   'label'=>'Sponsor\'s #',
                'attribute'=>'sponsor0.sponsorship.membershipNo',
                ],
            [   'label'=>'Parent Name',
                'value'=>'parent0.fullName',],
            [   'label'=>'Parent\'s #',
                'value'=>'parent0.sponsorship.membershipNo',
                ],
            //'lft',
            //'rgt',
            //'position',
            //'sponsor',
            //'level',
            //'Rank',
            //'prefPosition',
            //'prefix',
            //'RecordBy',
            [   'label'=>'Date Joined',
                'attribute'=>'RecordDate',
                //'value'=>'',
                'format'=>['date','php:d/m/Y'],
                ],
            //'ChangedBy',
            //'ChangedDate',

           // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
