<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reports\models\SponsorshipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sponsorships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponsorship-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sponsorship', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'member',
            'status',
            'membershipNo',
            'parent',
            //'lft',
            //'rgt',
            //'position',
            //'sponsor',
            //'level',
            //'Rank',
            //'prefPosition',
            //'prefix',
            //'RecordBy',
            //'RecordDate',
            //'ChangedBy',
            //'ChangedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
