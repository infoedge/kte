<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\basic\models\Contacts */

$this->title = Yii::t('app', 'Add Contacts for '.$contacts[0]->person->fullName);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Basic Info'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contacts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_1', [
        'contacts' => $contacts,
        'contactTypesCount' => $contactTypesCount,
        'contactTypeIds' =>  $contactTypeIds,
    ]) ?>
    <!--<h2>Contact Type IDs: No of contact Types = <?= $contactTypesCount ?></h2>
    <?php print_r($contactTypeIds)?>-->
</div>
