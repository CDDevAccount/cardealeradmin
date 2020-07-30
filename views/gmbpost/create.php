<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblLocalPost */

$this->title = 'Create Tbl Local Post';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Local Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-local-post-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
