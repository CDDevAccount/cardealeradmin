<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LinkCarImages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="link-car-images-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'imagename')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
