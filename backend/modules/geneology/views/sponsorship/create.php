<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use backend\modules\basic\assets\BasicAssets;
BasicAssets::register($this);

/* @var $this yii\web\View */
/* @var $model backend\modules\genealogy\models\Sponsorship */

$this->title = Yii::t('app', 'Manage Membership');
//$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sponsorships'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sponsorship-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h2>Member's List</h2>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [   'label' => 'Member\'s Name',
                'value' =>'member0.FullName',
                ],
            [
                'label' => 'Member Status',
                'value'=>'status0.Status',
                ],
            'membershipNo',
            'member0.user.email',
            [   
                'label' => 'Parent Name',
                'value'=>'parent0.FullName',
                ],
            [
                'label'=>'Sponsor\'s Name',
                'value' =>'sponsor0.FullName',
                ],
            //'level',
            //'Rank',
            //'RecordBy',
            //'RecordDate',
            //'ChangedBy',
            //'ChangedDate',

            ['class' => 'yii\grid\ActionColumn',
                'template'=> '{update}',
                ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
    
</div>
