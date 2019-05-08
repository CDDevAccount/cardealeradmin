<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\TblVehicles;
use app\models\TblDealer;
//use yii\grid\GridView;
use kartik\grid\GridView;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchVehicles */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vehicles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-vehicles-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Vehicle', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
       //     'id',
            ['attribute'=>'did', 
                'width'=>'250px',
                'filterType'=>GridView::FILTER_SELECT2,
                'filter'=>ArrayHelper::map(TblDealer::find()->orderBy('name')->asArray()->all(), 'id', 'name'), 
                'filterWidgetOptions'=>[
                    'pluginOptions'=>['allowClear'=>true],
                    ],
                'filterInputOptions'=>['placeholder'=>'Any ...'],
                'format'=>'raw'
            ],

            'make',
            'model',
            'colour',
            //'fuel_type',
            'year',
            'price',
            //'dealer_description:ntext',
            //'post_code',
            //'orig_url:url',
            //'full_name',
            //'mileage',
            //'model_type',
            //'engine_type',
            //'engine_size',
            //'transmission',
            //'doors',
            //'registration',
            //'phone',
            //'images:ntext',
            //'default_image',
            //'engine_configuration',
            //'seats',
            //'interior_colour',
            //'h1_text',
            //'status',
            //'detail_check',
            //'mot_check',
            //'mot_check_date',
            //'slug',
            //'model_family',
            //'listed_date',
            //'has_images',
            //'created_at',
            //'amended_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
