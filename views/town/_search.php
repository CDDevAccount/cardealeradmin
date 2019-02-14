<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchTowns */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-towns-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'town') ?>

    <?= $form->field($model, 'outcode') ?>

    <?= $form->field($model, 'town_slug') ?>

    <?= $form->field($model, 'longitude') ?>

    <?php // echo $form->field($model, 'latitude') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
