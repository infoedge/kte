<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\payments\models\TblgcodesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Tblgcodes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblgcodes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Tblgcodes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'code',
            'memberGen',
            'dateGen',
            'amount',
            //'retrivedate',
            //'retrieveBy',
            //'recordBy',
            //'recordDate',
            //'changedBy',
            //'changedDate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
