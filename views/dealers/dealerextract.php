<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UvwDealers40100 */
/* @var $form ActiveForm */
?>
<div class="dealers-dealerextract">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'Cars') ?>
        <?= $form->field($model, 'AveragePrice') ?>
        <?= $form->field($model, 'StockValue') ?>
        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'dealer_email') ?>
        <?= $form->field($model, 'dealer_privacy') ?>
        <?= $form->field($model, 'dealer_web') ?>
        <?= $form->field($model, 'phone') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- dealers-dealerextract -->
