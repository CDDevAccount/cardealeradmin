<?php

use yii\helpers\Html;
use yii\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'cars',
        'name',
        'status_name',
        'created_at:datetime',
        // ...
    ],
]) ?>