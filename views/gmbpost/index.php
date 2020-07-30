<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Searchgmbposts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tbl Local Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-local-post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tbl Local Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dealer_id',
            'vehicle_id',
            'created_at',
            'amended_at',
            //'local_id',
            //'post_type',
            //'start_date',
            //'end_date',
            //'start_time',
            //'end_time',
            //'summary',
            //'event_title',
            //'action_type',
            //'image_url:url',
            //'postname',
            //'cta_url:url',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
