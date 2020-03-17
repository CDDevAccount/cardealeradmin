<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblLocalPost */
/* @var $form ActiveForm */
?>
<div class="dealer-_gmb_form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'dealer_id') ?>
        <?= $form->field($model, 'vehicle_id') ?>
        <?= $form->field($model, 'created_at') ?>
        <?= $form->field($model, 'amended_at') ?>
        <?= $form->field($model, 'start_date') ?>
        <?= $form->field($model, 'end_date') ?>
        <?= $form->field($model, 'start_time') ?>
        <?= $form->field($model, 'end_time') ?>
        <?= $form->field($model, 'summary') ?>
        <?= $form->field($model, 'local_id') ?>
        <?= $form->field($model, 'action_type') ?>
        <?= $form->field($model, 'post_type') ?>
        <?= $form->field($model, 'event_title') ?>
        <?= $form->field($model, 'image_url') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- dealer-_gmb_form -->
