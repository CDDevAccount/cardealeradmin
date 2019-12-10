<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Carousel;
/* @var $this yii\web\View */
/* @var $model app\models\TblVehicles */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

foreach($images as $image){
    $pathinfo = pathinfo($image);
    $pics[]=['content'=> '<img src='.$image.'  />','caption'=>$model->registration.'- <EM><strong><mark>'.$pathinfo['filename'].'</mark></strong></em>.'.$pathinfo['extension'].Html::a('Update', ['/vehicle/carimages', 'reg' => $model->registration], ['class' => 'btn btn-primary'])];
}
//var_dump($pics);
//].'<a href="/vehicle/carimages?reg= "'.$model->id.' target="_blank">Delete</a>'];
?>
<div class="tbl-vehicles-view">

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
        <?= Html::a('View Dealer', ['/dealer/view', 'id' => $model->did], ['class' => 'btn btn-warning','target'=>'_blank']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'did',
            'make',
            'model',
            'colour',
            'fuel_type',
            'year',
            'price',
            'dealer_description:ntext',
            'post_code',
            'orig_url:url',
            'full_name',
            'mileage',
            'model_type',
            'engine_type',
            'engine_size',
            'transmission',
            'doors',
            'registration',
            'phone',
            'images:ntext',
            'default_image',
            'engine_configuration',
            'seats',
            'interior_colour',
            'h1_text',
            'status',
            'detail_check',
            'mot_check',
            'mot_check_date',
            'slug',
            'model_family',
            'listed_date',
            'has_images',
            'created_at',
            'amended_at',
        ],
    ]); 
    echo Carousel::widget([
        'items' => $pics,
    ]);
?>


</div>
