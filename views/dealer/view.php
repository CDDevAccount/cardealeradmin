<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblDealer */
//var_dump($model->vehicles);

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Dealers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-dealer-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'pid',
            'name',
            'branchname',
            'address1',
            'address2',
            'address3',
    	    'city',
    	    'district',
            'postcode',
            'phone',
             'dealer_phone_good:boolean',
            'mobile',
            'contact_name',
            'contact_title',
            'dealer_web',
            
    	    'dealer_email:email',
            'email_good:boolean',
            
    	    'dealer_privacy',
            'outcode',
            'fb_onboard:boolean',
            'cardealer:boolean',
            'dd_customer:boolean',
            'dealer_fb_page_id',
            'cc_email',
            'cd_phone_number',

            'updated_at',
            'created_at',
        ],
    ]) ?>

</div>
<div class ='row'>
    
    <?php
 //   sort($model->vehicles);
    foreach ($model->vehicles as $car) { ?>
        <div class='col-lg-2 col-sm-4 '>
            <div class="panel panel-default">
            <?php
       echo " $car->make $car->model_family £$car->price <a href='https://www.cardealer.co.uk/used-cars/for-sale/$car->slug'  target='_blank'>$car->registration</a><br>";
            ?>
            </div>
        </div>
    <?php
    }
    ?>
</div>