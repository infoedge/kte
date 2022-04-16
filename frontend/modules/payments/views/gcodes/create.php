<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblgcodes */

$this->title = Yii::t('app', 'Generate Gift Code');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Wallet'), 'url' => ['/dashboard/wallet/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblgcodes-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <!--<h5><?= 'MemberId: '.$membership->memberId ?></h5>
    <h5><?php print_r($memberDetails->getValidGcodesEmail()) ?></h5>-->
    <?= $this->render('_form_2', [
        'model' => $model,
        'myarr' => $myarr,
    ]) ?>
    <h3>Gift Codes Already Generated</h3>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'code',
            //'memberGen',
            'dateGen',
            [
                'label'=>'Worth US $',
                'value'=>'amount',
                ],
            'recipientEmail',
            'retrivedate',
            //'retrieveBy',
            //'recordBy',
            //'recordDate',
            //'changedBy',
            //'changedDate',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                ],
        ],
    ]); ?>
</div>
