<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\modules\payments\models\TblgcodesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Manage Gift Codes');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Config'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblgcodes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
       <!-- <?= Html::a(Yii::t('app', 'Create Tblgcodes'), ['create'], ['class' => 'btn btn-success']) ?>-->
       <?= Html::a(Yii::t('app', 'Cancel Expired Gift Codes'),['cancelexpired'] ,['class' => 'btn btn-success', 'name'=>'btn1', 'value'=>1]) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'code',
            [
                'attribute'=>'MemberGenerated',
                'value'=>'memberGen0.FullName',
                ],
            'dateGen',
            'expiryDate',
            'amount',
            //'walletId',
            'recipientEmail:email',
            'retrieveDate',
            'retrieveBy',
            
            //'recordBy',
            //'recordDate',
            //'changedBy',
            //'changedDate',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
