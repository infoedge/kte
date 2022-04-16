<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\dashboard\models\SponsorshipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'My Team');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponsorship-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <!--<?= Html::a(Yii::t('app', 'Create Sponsorship'), ['create'], ['class' => 'btn btn-success']) ?>-->
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <h3><?= Html::encode(Yii::t('app','Level 1')) ?></h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'Member Name',
                'value'=>'member0.FullName',
                ],
            'status0.Status',
            'membershipNo',
            'member0.phoneNo',
            'member0.user.email',
            //'parent',
            //'lft',
            //'rgt',
            //'position',
            //'sponsor',
            //'level',
            //'Rank',
            //'prefPosition',
            //'RecordBy',
            //'RecordDate',
            //'ChangedBy',
            //'ChangedDate',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <h3>Level 2</h3>
     <?= GridView::widget([
        'dataProvider' => $dataProvider2,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'=>'Member Name',
                'value'=>'member0.FullName',
                ],
            'status0.Status',
            'membershipNo',
            'member0.phoneNo',
            'member0.user.email',
            //'parent',
            //'lft',
            //'rgt',
            //'position',
            //'sponsor',
            //'level',
            //'Rank',
            //'prefPosition',
            //'RecordBy',
            //'RecordDate',
            //'ChangedBy',
            //'ChangedDate',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
