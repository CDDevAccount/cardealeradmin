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
		[
			'label'=>'Edit', 
			'format' => 'raw',
		    'value'=>function ($data) {
		        return Html::a(Html::encode("View"),'/gmbpost');
		    },
		],

        // ...
    ],
]) ?>