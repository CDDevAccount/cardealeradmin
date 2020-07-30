<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Searchgmbposts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-local-post-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'dealer_id') ?>

    <?= $form->field($model, 'vehicle_id') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'amended_at') ?>

    <?php // echo $form->field($model, 'local_id') ?>

    <?php // echo $form->field($model, 'post_type') ?>

    <?php // echo $form->field($model, 'start_date') ?>

    <?php // echo $form->field($model, 'end_date') ?>

    <?php // echo $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'end_time') ?>

    <?php // echo $form->field($model, 'summary') ?>

    <?php // echo $form->field($model, 'event_title') ?>

    <?php // echo $form->field($model, 'action_type') ?>

    <?php // echo $form->field($model, 'image_url') ?>

    <?php // echo $form->field($model, 'postname') ?>

    <?php // echo $form->field($model, 'cta_url') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
