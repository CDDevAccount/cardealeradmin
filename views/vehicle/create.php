<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblVehicles */

$this->title = 'Create Tbl Vehicles';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Vehicles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-vehicles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
