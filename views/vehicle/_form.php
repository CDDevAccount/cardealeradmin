<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblVehicles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-vehicles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'did')->textInput() ?>

    <?= $form->field($model, 'make')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'colour')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fuel_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dealer_description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'post_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orig_url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mileage')->textInput() ?>

    <?= $form->field($model, 'model_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine_size')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transmission')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doors')->textInput() ?>

    <?= $form->field($model, 'registration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'images')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'default_image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'engine_configuration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'seats')->textInput() ?>

    <?= $form->field($model, 'interior_colour')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'h1_text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'detail_check')->textInput() ?>

    <?= $form->field($model, 'mot_check')->textInput() ?>

    <?= $form->field($model, 'mot_check_date')->textInput() ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model_family')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'listed_date')->textInput() ?>

    <?= $form->field($model, 'has_images')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'amended_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
