<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
/* @var $this yii\web\View */
/* @var $model app\models\TblDealer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-dealer-form">
 <div class='col-md-4'>
    <?php $form = ActiveForm::begin(); ?>
    <div class='panel panel-default'>
        <div class='panel-heading'>
        Address Details</div>
        <div class="panel-body">    
            <?php // $form->field($model, 'pid')->textInput() ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'branchname')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'address1')->textInput(['maxlength' => true])->label('Address') ?>
            <?= $form->field($model, 'address2')->textInput(['maxlength' => true])->label(false) ?>
            <?= $form->field($model, 'address3')->textInput(['maxlength' => true])->label(false) ?>
            <?= $form->field($model, 'district')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'postcode')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'outcode')->textInput(['maxlength' => true]) ?>
            <div class='row'>
            <div class='col-md-6'>
            <?= $form->field($model, 'longitude')->textInput(['maxlength' => true,'style'=>'width:100px'])->label('Long.') ?>
            </div>
            <div class='col-md-6'>
                <?= $form->field($model, 'latitude')->textInput(['maxlength' => true,'style'=>'width:100px'])->label('Lat.') ?>
            </div>
            </div>
        </div>
    </div>
</div>
 <div class='col-md-4'>
    <div class='panel panel-default'>
        <div class='panel-heading'>
        Address Details</div>
        <div class="panel-body">
            <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'contact_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'dealer_web')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'dealer_email')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'dealer_privacy')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>    <?= $form->field($model, 'website_provider')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dms_provider')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

</div>
<div class='col-md-4'>
    <div class='panel panel-default'>
        <div class='panel-heading'>
        Facebook Feed Options</div>
        <div class="panel-body">
            <?= $form->field($model, 'fb_onboard')->checkbox(array('label'=>''))->label('Send to Facebook ?');//(['maxlength' => true]) ?>

            <?= $form->field($model, 'cardealer')->checkbox(array('label'=>''))->label('Subscribed to Car Dealer ?');//(['maxlength' => true]) ?>
        </div>
    </div>


	<?php //$form->field($model, 'updated_at')->textInput() ?>

    <?php //$form->field($model, 'created_at')->textInput() ?>



    <?= $form->field($model, 'comment')->widget(TinyMce::className(), [
        'options' => ['rows' => 25],
        'language' => 'en',
        'clientOptions' => [
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        ]
    ]);?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
