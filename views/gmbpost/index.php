<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\TblLocalPostStatus;
use app\models\TblDealer;
/* @var $this yii\web\View */
/* @var $searchModel app\models\Searchgmbposts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Google Rocket Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-local-post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Tbl Local Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

       //     'id',
          //  'dealer_id',
            [
                'attribute'=>'dealer_id',
                'label'=>'Dealer Name',
                'filter'    => ArrayHelper::map(TblDealer::find()->orderBy('id')->where(['not',['gmb_locationid'=>NULL]])->all(), 'id', 'name'),
                'format'=>'text',//raw, html
                'content'=>function($data){
                    return $data->dealer->name;
                }
            ],
      //      'vehicle_id',
            ['class' => 'yii\grid\ActionColumn'],
            [
                'attribute'=>'vehicle_id',
                'label'=>'Make/Model',
                'format'=>'text',//raw, html
                'filter'=>false,
                'content'=>function($data){
                    return $data->vehicle->make.' '.$data->vehicle->model;
                }
            ],
            [

                'attribute' => 'img',

                'format' => 'html',

                'label' => 'Image Used',

                'value' => function ($data) {
                    $url = $data->image_url;
                    return Html::img($url ,

                        ['width' => '120px']);

                },

            ],
            [
                'attribute'=>'summary',
                'label' => 'Summary',
                'filter'=>false,
                'contentOptions' => ['style' => 'width:200px; white-space: normal;'],

            ],
           // 'cta_url:url',
            [
                'attribute' => 'status',
                'headerOptions' => ['style' => 'width:10%'],
                'contentOptions' => ['style' => 'width:200px;'],     
                'filter'    => ArrayHelper::map(TblLocalPostStatus::find()->orderBy('status')->all(), 'status', 'status_name'),
                'content' => function($data){
                    return $data->status;
                }
            ],
            //'summary',
            //'event_title',
            //'action_type',
          //  'image_url:url',
            //'postname',
            [
                'attribute'=>'cta_url',
                'label' => 'Deep Link',
                'format'=> 'url',
                'filter'=>false,
                'contentOptions' => ['style' => 'width:200px; white-space: normal;'],               
            ],

          //  'status',


            
        ],
    ]); ?>
</div>
