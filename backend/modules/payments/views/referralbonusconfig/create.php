<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\modules\payments\models\Referralbonusconfig */

$this->title = Yii::t('app', 'Referral Bonus Configuration');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Payment Configuration'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="referralbonusconfig-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <h2>Listed Configurations</h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'trxType0.ptypeName',
            'sPackage0.packName',
            'sRank0.rankName',
            'mPackage0.packName',
            'level',
            'amount',
            //'recordBy',
            //'recordDate',
            //'configCntrl',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{update}',
                ],
        ],
    ]); ?>
</div>
