<?php

use yii\helpers\Html;
// use yii\grid\GridView;
use  \kartik\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchDealer */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dealers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-dealer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create New Dealer', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Dealer Facebook Map', ['facebooked'], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Dealer Map', ['map'], ['class' => 'btn btn-danger']) ?>

    </p>
    <h2> Being edited by <?= \Yii::$app->user->identity->username ?></h2>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    	'filterModel' => $searchModel,
    	'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'resizableColumns'=>true,
        'floatHeader'=>true,
        'floatHeaderOptions'=>['top'=>'50'],

        'columns' => [
        //    ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],
        //    'id',
        //    'pid',
            'name',
           // 'branchname',
          //  'address1',
            //'address2',
            //'address3',
           // 'city',
            'postcode',
    //        'phone',
        [
            'label' => 'Go Cardless Signed',
            'attribute' => 'dd_customer',
            'format' => 'boolean',
            'filter' => [0=>'No',1=>'Yes'],
           // 'filterType' => GridView::FILTER_SWITCH,
        ],
            //'contact_name',
            //'contact_title',
//	    'dealer_web',
//	    'website_provider',
//	    'dms_provider',
//	    'has_stock',
//	    'longitude',
//	    'latitude',
            //'dealer_email:email',
            //'outcode',
     //       'comment:html',
            'email_good:boolean',

            'vehicle_count',
            'fb_onboard:boolean',
            'cardealer:boolean',
            'verified:boolean',
            'updated_at',



            //'created_at',

        ],
    ]); ?>

</div>
