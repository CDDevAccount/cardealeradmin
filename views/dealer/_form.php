<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use dosamigos\tinymce\TinyMce;
use kartik\switchinput\SwitchInput;
use kartik\checkbox\CheckboxX;
use kartik\form\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\TblDealer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-dealer-form">
 <div class='col-md-4'>
    <?php $form = ActiveForm::begin(); ?>

    <?php if ($model->dd_customer==1) {?>
        <div class='panel panel-danger'>
    <?php }else{ ?>
        <div class='panel panel-default'>
    <?php } ?>
        <div class='panel-heading '>Address Details</div>
        
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
    <?php if ($model->dd_customer==1) {?>
        <div class='panel panel-danger'>
    <?php }else{ ?>
        <div class='panel panel-default'>
    <?php } ?>
        <div class='panel-heading'>Contact Details</div>
        <div class="panel-body">
            <?= $form->field($model, 'contact_name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'contact_title')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'dealer_web')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'dealer_email')->textInput(['maxlength' => true]) ?>

             <?= $form->field($model, 'email_good')->checkBox(['label' => 'Email/PrivacyUrl/Phone Ready and Verified?']); ?>
            <?= $form->field($model, 'dealer_privacy')->textInput(['maxlength' => true])->label('"No" or Dealer Privacy Url') ?>
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dealer_phone_good')->checkbox(array('label'=>'Phone Checked'))->label('Phone verified?'); ?>
            <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>    <?= $form->field($model, 'website_provider')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'dms_provider')->textInput(['maxlength' => true]) ?>

        </div>
    </div>

</div>
<div class='col-md-4'>
    <?php if ($model->dd_customer==1) {?>
        <div class='panel panel-danger'>
    <?php }else{ ?>
        <div class='panel panel-default'>
    <?php } ?>
        <div class='panel-heading'>
        Account & FB Options</div>
        <div class="panel-body">

            <?= $form->field($model, 'cardealer')->checkBox(['label' => 'Activated On Car Dealer?']); ?>

            <?= $form->field($model, 'fb_onboard')->checkBox(['label' => 'Stock To Facebook?']);//(['maxlength' => true]) ?>

            <?= $form->field($model, 'dd_customer')->checkBox(['label' => 'Go Cardless Active?']) ; ?>

            <?= $form->field($model, 'cd_phone_number')->textInput(['maxlength' => true]) ; ?>

            <?= $form->field($model, 'dealer_fb_page_id')->textInput(['maxlength' => true]) ; ?>

            <?= $form->field($model, 'verified')->checkBox(['label' => 'Farwa - Please confirm details verified','data-size'=>'small', 'class'=>'bs_switch' ,'style'=>'margin-bottom:4px;', 'id'=>'active']) ?>


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
