<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\grid\GridView;

$types= array('Coupe','Convertible','Estate','Hatchback', 'MPV', 'Saloon', 'Pick up', 'SUV');
$monthparam= array(1,2,3,4,5,6);
$fromparam=array(1000,2000,3000,4000,5000,6000,7000,8000,9000,10000);
$toparam=array(10000,15000,20000,25000,30000,35000,40000);

$script = <<< JS
      $(document).ready(function() {
            $("#submit").click(function(){      

              $("#myselection option:selected").text();
          //    alert($("#myfrom option:selected").text());
    			window.location.href = '/stats/stats?body='+$("#myselection option:selected").text()+'&month='+$("#mymonth option:selected").text()+'&from='+$("#myfrom option:selected").text()+'&to='+$("#myto option:selected").text();
              });
         }); 
JS;
$this->registerJs($script);

?>

<h1>Sales Analysis - Popular Models</h1>
<div class='row'>
<div class="panel-heading" style="text-align:center">
	<?= Html::dropDownList('type',$selected,$types,['prompt'=>'Body type','id' => 'myselection','class'=>'selectpicker', 'data-style'=>'btn-primary']) ?>
	<?= Html::dropDownList('time',$seltime,$monthparam,['prompt'=>'Months...','id' => 'mymonth']) ?>
	<?= Html::dropDownList('from',$selfrom,$fromparam,['prompt'=>'From £...','id' => 'myfrom']) ?>
	<?= Html::dropDownList('to',$selto,$toparam,['prompt'=>'To £..','id'=>'myto']) ?>

	<button id="submit" class='btn-small btn-information dropdown-toggle'>Go Get 'Em &gt;&gt;</button>
</div>
</div>
<div class='row'>
	<div class='col-sm-12'>
		<div class='panel panel-default'>
			<div class="panel-heading" style="text-align:center">
				<h3 class="panel-title" display: inline-block>£<?=$from?> to £<?=$to?> - Popular <?= $body?> in the last <?=$months?> <?=($months=='1')?'Month':'Months'?></h3>
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
				//	'filterModel' => $searchModel,
					'layout' => "{summary}\n{items}\n{pager}",
				        'columns' => [
							[
							    'label' => 'Make',
							    'attribute' =>'Make',
							    'format'=>['text']
							],		
							[
							    'label' => 'Model',
							    'attribute' =>'ModelFamily',
							    'format'=>['text']
							],
														[
							    'label' => 'Full Model Description',
							    'attribute' =>'FullModel',
							    'format'=>['text']
							],	
							[
							    'label' => 'Fuel Type',
							    'attribute' =>'Fuel',
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
  				Summary
  			</div>
		</div>
	</div>
</div>