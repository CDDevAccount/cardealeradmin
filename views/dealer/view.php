<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblDealer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Dealers', 'url' => ['index']];
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
            'postcode',
            'phone',
            'mobile',
            'contact_name',
            'contact_title',
            'dealer_web',
            'dealer_email:email',
            'outcode',
            'updated_at',
            'created_at',
        ],
    ]) ?>

</div>
