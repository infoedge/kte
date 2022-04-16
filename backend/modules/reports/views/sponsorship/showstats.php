<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\reports\models\SponsorshipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'All Members Statistics';
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
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'FullName',
             
            'membershipNo',
            'member',
            [
                'attribute'=> 'Level',
                'value'=>'l1',
                ],
            'phoneNo',
            'email',
            'SponsoredLft',
            'SponsoredRgt',
            'NoSponsored',
            'TeamLft',
            'TeamRgt',
            
            
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
