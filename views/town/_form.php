<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblTowns */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-towns-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'town')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'outcode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'town_slug')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'longitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'latitude')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
