<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchDealer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-dealer-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= // $form->field($model, 'id') ?>

    <?= // $form->field($model, 'pid') ?>

    <?= $form->field($model, 'name') ?>

    <?= // $form->field($model, 'branchname') ?>

    <?= $form->field($model, 'address1') ?>

    <?php // echo $form->field($model, 'address2') ?>

    <?php // echo $form->field($model, 'address3') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php  echo $form->field($model, 'postcode') ?>

    <?php  echo $form->field($model, 'phone') ?>
    <?php  echo $form->field($model, 'email_good') ?>

    <?php // echo $form->field($model, 'mobile') ?>

    <?php // echo $form->field($model, 'contact_name') ?>

    <?php // echo $form->field($model, 'contact_title') ?>

    <?php  echo $form->field($model, 'dealer_web') ?>
    <?php  echo $form->field($model, 'has_stock') ?>

    <?php  //echo $form->field($model, 'dealer_email') ?>

    <?php // echo $form->field($model, 'outcode') ?>
    <?php  echo $form->field($model, 'longitude') ?>
    <?php  echo $form->field($model, 'latitude') ?>
    <?php echo $form->field($model,'verified') ?>
    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
