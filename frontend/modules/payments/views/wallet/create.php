<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\payments\models\Tblwtpwd */

$this->title = Yii::t('app', 'Create Wallet Password');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dashboard'), 'url' => ['/dashboard/default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tblwtpwd-create">
    <div class="col-sm-offset-3">
        <h1><?= Html::encode($this->title) ?></h1>

        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>
    </div>
</div>
