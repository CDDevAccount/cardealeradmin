<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblDealer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-dealer-form">
 <div class='col-md-6'>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pid')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branchname')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address2')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'address3')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
</div>
 <div class='col-md-6'>
    <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contact_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dealer_web')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dealer_email')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'website_provider')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dms_provider')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dealer_privacy')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fb_onboard')->checkbox(array('label'=>''))->label('Send to Facebook ?');//(['maxlength' => true]) ?>

    <?= $form->field($model, 'cardealer')->checkbox(array('label'=>''))->label('Subscribed to Car Dealer ?');//(['maxlength' => true]) ?>

    <?= $form->field($model, 'outcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

	<?php //$form->field($model, 'updated_at')->textInput() ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
