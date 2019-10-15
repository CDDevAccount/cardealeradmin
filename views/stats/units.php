<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;
//$(this)->registerAssetBundle(yii\web\JqueryAsset::className(), View::POS_HEAD);

$types= [
	'coupe'  => 'Coupe',
    'convertible' => 'Convertible',
    'estate' => 'Estate',
    'hatchback' => 'Hatchback',
    'mpv' => 'MPV',
    'saloon' => 'Saloon',
//    'sports' => 'Sports',
    'suv' => 'SUV',

	];

$script = <<< JS
      $(document).ready(function() {
            $("#submit").click(function(){      

              $("#myselection option:selected").text();
    			window.location.href = '/stats/type?model_type='+$("#myselection option:selected").text();
 
              });
         }); 
JS;
$this->registerJs($script);

?>
<style>
	.panel {
    overflow: auto;
}
</style>
<h1>Sales Analysis - Popular Models</h1>
<div class='row'>
	<?= Html::dropDownList('type',$selected,$types, ['prompt' => '--- select ---','id' => 'myselection']) ?>
	<button id="submit">Result</button>
</div>
<div class='row'>
	<div class='col-sm-6'>
		<div class='panel panel-default'>
			<div class="panel-heading" style="text-align:center">
				<h3 class="panel-title" display: inline-block>£5K to £15K - Popular <?= $model_type?></h3>
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
							    'label' => 'Make',
							    'attribute' =>'make',
							    'format'=>['text']
							],		
							[
							    'label' => 'Model',
							    'attribute' =>'model_family',
							    'format'=>['text']
							],		
							[
							    'label' => 'Units',
							    'attribute' =>'Units',
							    'format'=>['integer']
							],				        	
				        ],
				    ]); 
				    ?>
			
  			</div>
  			<div class="panel-footer">
  				Footnote
  			</div>
		</div>
	</div>
</div>


