<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblDealer */

$this->title = 'Create Tbl Dealer';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Dealers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tbl-dealer-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
