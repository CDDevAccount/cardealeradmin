<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchVehicles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-vehicles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'did') ?>

    <?= $form->field($model, 'make') ?>

    <?= $form->field($model, 'model') ?>

    <?= $form->field($model, 'colour') ?>

    <?php // echo $form->field($model, 'fuel_type') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'dealer_description') ?>

    <?php // echo $form->field($model, 'post_code') ?>

    <?php // echo $form->field($model, 'orig_url') ?>

    <?php // echo $form->field($model, 'full_name') ?>

    <?php // echo $form->field($model, 'mileage') ?>

    <?php // echo $form->field($model, 'model_type') ?>

    <?php // echo $form->field($model, 'engine_type') ?>

    <?php // echo $form->field($model, 'engine_size') ?>

    <?php // echo $form->field($model, 'transmission') ?>

    <?php // echo $form->field($model, 'doors') ?>

    <?php // echo $form->field($model, 'registration') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'images') ?>

    <?php // echo $form->field($model, 'default_image') ?>

    <?php // echo $form->field($model, 'engine_configuration') ?>

    <?php // echo $form->field($model, 'seats') ?>

    <?php // echo $form->field($model, 'interior_colour') ?>

    <?php // echo $form->field($model, 'h1_text') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'detail_check') ?>

    <?php // echo $form->field($model, 'mot_check') ?>

    <?php // echo $form->field($model, 'mot_check_date') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'model_family') ?>

    <?php // echo $form->field($model, 'listed_date') ?>

    <?php // echo $form->field($model, 'has_images') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'amended_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
