<?php

use yii\helpers\Html;
use yii\grid\GridView;
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
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => ''],
    	'filterModel' => $searchModel,
    	'layout' => "{summary}\n{pager}\n{items}\n{pager}",
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\ActionColumn'],

        //    'id',
        //    'pid',
            'name',
           // 'branchname',
            'address1',
            //'address2',
            //'address3',
           // 'city',
            'postcode',
    //        'phone',
            'dd_customer:boolean',
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
            'comment:html',
            'email_good:boolean',
            'vehicle_count',
            'fb_onboard:boolean',
            'cardealer:boolean',
            //'updated_at',
            //'created_at',

        ],
    ]); ?>
</div>
