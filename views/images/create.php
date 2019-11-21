<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LinkCarImages */

$this->title = 'Create Link Car Images';
$this->params['breadcrumbs'][] = ['label' => 'Link Car Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-car-images-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
