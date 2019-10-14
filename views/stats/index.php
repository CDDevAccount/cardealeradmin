<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;

?>
<style>
	.panel {
    overflow: auto;
}
</style>
<h1>Stats Quicklook</h1>

<div class='row'>
	<div class='col-sm-6'>
		<div class='panel panel-default'>
			<div class="panel-heading" style="text-align:center">
				<h3 class="panel-title" display: inline-block>Dealer's Stock</h3>
			</div>
	  		<div class="panel-body">
	  		
	    		    <?= GridView::widget([
					'tableOptions' => [
					    'class' => 'table table-striped',
					],
					'options' => [
					    'class' => 'table-responsive',
					],
			        'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'layout' => "{summary}\n{items}\n{pager}",
				        'columns' => [
							[
							    'label' => 'Units',
							    'attribute' =>'Quantity',
							    'format'=>['integer']
							],				        	

											            'name',
							[
							    'label' => 'Value',
							    'attribute' =>'DealerValue',
							   // 'contentOptions' => ['class' => 'col-lg-1'],
							    'format'=>['decimal',0]
							],


							//				            'DealerValue',
							[
							    'label' => 'Max',
							    'attribute' =>'CarMaxValue',
							 //  'contentOptions' => ['class' => 'col-lg-1'],
							    'format'=>['decimal',0]
							],

							[
							    'label' => 'Avg',
							    'attribute' =>'CarAverageValue',
							  //  'contentOptions' => ['class' => 'col-lg-1'],
							    'format'=>['decimal',0]
							]

				        ],
				    ]); 
				    ?>
			
  			</div>
  			<div class="panel-footer">
  				Footnote
  			</div>
		</div>
	</div>
	<div class='col-sm-6'>
		<div class='panel  panel-default'>
			<div class="panel-heading" style="text-align:center">
				<h3 class="panel-title">Dealer's Leads</h3>
			</div>
	  		<div class="panel-body">
	    		    <?= GridView::widget([
					'tableOptions' => [
					    'class' => 'table table-striped',
					],
					'options' => [
					    'class' => 'table-responsive',
					],
			        'dataProvider' => $fbleadProvider,
				        'columns' => [
							[
							    'label' => 'Units',
							    'attribute' =>'Units',
							    'format'=>['integer']
							],				        	

											            'Dealer',
							[
							    'label' => 'Value',
							    'attribute' =>'Total',
							   // 'contentOptions' => ['class' => 'col-lg-1'],
							    'format'=>['decimal',0]
							],

							[
							    'label' => 'Avg',
							    'attribute' =>'AverageValue',
							  //  'contentOptions' => ['class' => 'col-lg-1'],
							    'format'=>['decimal',0]
							]

				        ],
				       ]); 
			        ?>
  			</div>
  			<div class="panel-footer">
  				Footnote
  			</div>
		</div>
	</div>
	<div class='col-sm-6'>
		<div class='panel  panel-default'>
			<div class="panel-heading" style="text-align:center">
				<h3 class="panel-title">Vehicles</h3>
			</div>
	  		<div class="panel-body">
	    		Panel content
  			</div>
  			<div class="panel-footer">
  				Footnote
  			</div>
		</div>
	</div>
	<div class='col-sm-6'>
		<div class='panel  panel-default'>
			<div class="panel-heading" style="text-align:center">
				<h3 class="panel-title">Car Dealer Media</h3>
			</div>
	  		<div class="panel-body">
	    		Panel content
  			</div>
  			<div class="panel-footer">
  				Footnote
  			</div>
		</div>
	</div>
</div>


