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
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'id',
        //    'pid',
            'name',
           // 'branchname',
            'address1',
            //'address2',
            //'address3',
           // 'city',
            'postcode',
            'phone',
            //'mobile',
            //'contact_name',
            //'contact_title',
            'dealer_web',
            'dealer_email:email',
            //'outcode',
            //'updated_at',
            //'created_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
