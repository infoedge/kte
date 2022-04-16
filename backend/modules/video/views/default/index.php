<?php
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\video\models\VideotopicsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Training Videos');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="video-default-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-sm-4">
    <?= Html::a(Yii::t('app', 'Add to Video List'), ['videolist/create'], ['class' => 'btn btn-primary btn-block']) ?></br>
    <?= Html::a(Yii::t('app', 'Add Video Topics'), ['videotopics/create'], ['class' => 'btn btn-primary btn-block']) ?></br>
    <?= Html::a(Yii::t('app', 'Add Video Types'), ['videotypes/create'], ['class' => 'btn btn-primary btn-block']) ?></br>
        </div>
    </div>
</div>
