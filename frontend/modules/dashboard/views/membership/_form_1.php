<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
?>

<?php $form = ActiveForm::begin(); ?>
<?php Pjax::begin() ?>
<h3>Action</h3>
<?= Html::a(Html::encode('Back to Top'), ['/dashboard/membership/genealogy', 'memberId' => Yii::$app->userdetails->getPersonId(Yii::$app->user->id)], ['class' => 'btn btn-block btn-primary']) ?>

<hr>

<?= $form->field($membership, 'searchMember')->textInput([ 'title' => 'Enter Membership #', 'placeholder' => 'Search by Member #']) ?>
<?= Html::submitButton('Search', ['id' => 'goSearch', 'title' => 'Click to Search']) ?>
<hr>
<?php Pjax::end(); ?>
<?php ActiveForm::end(); ?>