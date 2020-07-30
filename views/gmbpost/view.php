<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblLocalPost */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Local Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tbl-local-post-view">

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
            'dealer_id',
            'vehicle_id',
            'created_at',
            'amended_at',
            'local_id',
            'post_type',
            'start_date',
            'end_date',
            'start_time',
            'end_time',
            'summary',
            'event_title',
            'action_type',
            'image_url:url',
            'postname',
            'cta_url:url',
        ],
    ]) ?>

</div>
