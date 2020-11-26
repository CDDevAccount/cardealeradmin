<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\TblDealer */

$this->title = 'Facebook Leads This Month';
$this->params['breadcrumbs'][] = ['label' => 'Facebook', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container-fluid" >
    <h1><?= Html::encode($this->title) ?></h1>
    <div class = 'row'>
    	<div class = 'col-lg-6'>
		  		<div class="panel-body">
	    		    <?= GridView::widget([
					'tableOptions' => [
					    'class' => 'table table-striped',
					],
					'options' => [
					    'class' => 'table-responsive',
					],
			        'dataProvider' => $fbdaily,
					'layout' => "{summary}\n{items}\n{pager}",
									    ]); 
				    ?>
				</div>
		</div>
		<div class = 'col-lg-6'>
		  		<div class="panel-body">
	    		    <?= GridView::widget([
					'tableOptions' => [
					    'class' => 'table table-striped',
					],
					'options' => [
					    'class' => 'table-responsive',
					],
			        'dataProvider' => $fbweekday,
					'layout' => "{summary}\n{items}\n{pager}",
									    ]); 
				    ?>
				</div>
		</div>

</div>