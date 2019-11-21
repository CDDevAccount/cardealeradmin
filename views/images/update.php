<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LinkCarImages */

$this->title = 'Update Link Car Images: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Link Car Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="link-car-images-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
