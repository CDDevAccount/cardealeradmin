<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblDealer */

$this->title = 'Update Tbl Dealer: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Dealers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tbl-dealer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
