<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblTowns */

$this->title = 'Create Tbl Towns';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Towns', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-towns-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
