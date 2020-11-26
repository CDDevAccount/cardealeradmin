<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$listData=['0' => 'Un Assigned', '1' => 'Queued', '2' => 'Advertised', '3'=> 'Marked for deletion','4'=>'Deleted from GMB'];
/* @var $this yii\web\View */
/* @var $model app\models\TblLocalPost */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-local-post-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class='row'>
        <div class='col-lg-6'>

            <?php echo '<h2>'.$model->dealer->name.'</h2>' ?>

            <?php echo  '<h3>'.$model->vehicle->make.' ~ '.$model->vehicle->model.'</h3>'; ?>

            <?= $form->field($model, 'post_type')->textInput(['maxlength' => true,'readonly'=> true]) ?>

            <img src=<?=$model->image_url ?> width="400" >

        </div>

        <div class='col-lg-6'>

        <?= $form->field($model, 'summary')->textarea(array('rows'=>10,'cols'=>5)) ?>

        <?= $form->field($model, 'event_title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'status')->dropDownList(
                $listData, 
                ['prompt'=>'Choose...']
                ); ?>
        </div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
