<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use  \kartik\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchDealer */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Signed Dealers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-dealer-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    //	'filterModel' => $searchModel,
    	'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'resizableColumns'=>true,
        'floatHeader'=>true,
        'floatHeaderOptions'=>['top'=>'50'],

        'columns' => [
            'Dealer',
            'Cars',
            'LatestStockDate',
         //   'DaysAgo',
            'StockValue',
            'AverageValue',
            [
                'label' => 'DaysAgo',
                'attribute' => 'DaysAgo',
                'contentOptions' => function ($model, $key, $index, $column) {
                        return ['style' => 'background-color:' 
                            . ($model->DaysAgo >= 7 ? 'red' : 'green')];
                },
            ],
        ],
    ]); ?>

</div>