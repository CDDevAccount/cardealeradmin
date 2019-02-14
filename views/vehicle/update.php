<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblVehicles */

$this->title = 'Update Tbl Vehicles: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-vehicles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
