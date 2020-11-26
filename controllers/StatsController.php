<?php

namespace app\controllers;

use Yii;
use app\models\TblDealer;
use app\models\TblVehicles;
use app\models\UvwTotalsByPostcodeDealer;
use app\models\UvwCurrentStockFBLeads;
use app\models\UvwUnitsConvertible;
use app\models\UvwUnitsCoupe;
use app\models\UvwUnitsEstate;
use app\models\UvwUnitsHatchBack;
use app\models\UvwUnitsMPV;
use app\models\UvwUnitsPickups;
use app\models\UvwUnitsSaloon;
use app\models\UvwUnitsSUV;
use app\models\UvwTodaysFBLeads;
use app\models\UvwFacebookLeadsThisMonth;
use app\models\UvwFacebookLeadsByWeekdayThisMonth;

use app\models\SearchLiveDealer;
use app\models\SearchDealerTotals;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;


use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;


class StatsController extends \yii\web\Controller
{
    
    public function actionIndex()
    {
        $searchModel = new SearchDealerTotals();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	$dataProvider->pagination = ['pageSize' => 20];

    	$leadsProvider= new ActiveDataProvider([
		    'query' => UvwCurrentStockFBLeads::find(),
		    'pagination' => [
		        'pageSize' => 20,
		    ],
    	]);

		$todayleadProvider= new ActiveDataProvider([
		    'query' => UvwTodaysFBLeads::find(),
		    'pagination' => [
		        'pageSize' => 20,
		    ],
		]);
    	
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
    	}else{
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'fbleadProvider'=>$leadsProvider,
                'todayleadsProvdier'=>$todayleadProvider,
        	]);
    	}
        return $this->render('index');
    }

    
    public function actionStats($body='Coupe',$month=1,$from=5000,$to=15000)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
    	}else{

		    	$param1=$month;
		    	$param2=$body;
		    	$param3=$from;
		    	$param4=$to;
		 
		    	$result = \Yii::$app->db->createCommand("CALL usp_SalesStatsGenerator(:paramName1, :paramName2,:paramName3,:paramName4)") 
		                      ->bindValue(':paramName1' , $param1 )
		                      ->bindValue(':paramName2', $param2)
		                      ->bindValue(':paramName3', $param3)
		                      ->bindValue(':paramName4', $param4)
		                      ->queryAll();

				$provider = new ArrayDataProvider([
				    'allModels' => $result,
				    'sort' => [
				        'attributes' => ['make', 'units'],
				    ],
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);
		// get the posts in the current page
				$posts = $provider->getModels();
				return $this->render('stats',[
					'dataProvider'=>$provider,
					'body'=>$body,
					'months'=>$month,
					'from'=>$from,
					'to'=>$to
				]);
		}
    }
/*

Map of leads over time
If the new options is selected the map shows just those customers who have not signed a DD
e.g. Are not Car Dealer Customers
*/

    public function actionMap($days=1,$new=0)
    {
    	//die(var_dump('here'));
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
    	}else{
				$coord = new LatLng(['lat' => 52.658092, 'lng' => -1.120892]);
	    		$map = new Map([
	    		    'center' => $coord,
	    		    'zoom' => 7,
	    		    'width'=>'100%',
	    		    'height'=>'800'
	    		]);

		    	$param1=$days;
		    	switch ($new){
		    		case 0:
			    	$result = \Yii::$app->db->createCommand("CALL usp_FacebookLeads(:paramName1)") 
			                      ->bindValue(':paramName1' , $param1 )
			                      ->queryAll();			    		
		    		break;
		    		case 1:
			    	$result = \Yii::$app->db->createCommand("CALL usp_FacebookLeads4NonCustomers(:paramName1)") 
			                      ->bindValue(':paramName1' , $param1 )
			                      ->queryAll();		    		
		    		break;
		    		case 2;
			    	$result = \Yii::$app->db->createCommand("CALL usp_FacebookLeads4Customers(:paramName1)") 
			                      ->bindValue(':paramName1' , $param1 )
			                      ->queryAll();	
		    		break;

		    	}

/*
		 		if ($new){
			    	$result = \Yii::$app->db->createCommand("CALL usp_FacebookLeads4NonCustomers(:paramName1)") 
			                      ->bindValue(':paramName1' , $param1 )
			                      ->queryAll();
		 		}else{
			    	$result = \Yii::$app->db->createCommand("CALL usp_FacebookLeads(:paramName1)") 
			                      ->bindValue(':paramName1' , $param1 )
			                      ->queryAll();		 			
		 		}

*/
				foreach($result as $lead){
				//	var_dump($lead['latitude']);
					$vc=$lead['leads'];
					$coord=new LatLng(['lat'=>$lead['latitude'],'lng'=>$lead['longitude']]);		
					$marker=new Marker([
						'position'=>$coord,
						'title'=>$lead['dealer']]);
					$marker->attachInfoWindow(
		    				new InfoWindow([
		        				'content' => '<p>'.$lead['dealer'].'</p><p>'.$vc.' Leads</p>'
		    				])
						);	
					$map->addOverlay($marker);
				}
				return $this->render('fbleads',['map'=>$map]); 
		}
    }



    public function actionType($model_type=false)
    {

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
    	}else{
    		if (!$model_type){

    		}else{

    			$dp=$this->getProvider($model_type);
    	//		var_dump($dp);
    			if ($dp){
		            return $this->render('units', [
		                'searchModel' => $searchModel,
		                'dataProvider' => $dp,
		                'model_type'=>$model_type,
		        	]);
    			}

    		}
    	}
    }


    public function actionFacebook()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
    	}else{
			$thisMonthFacebookByDay = new ActiveDataProvider([
			    'query' => UvwFacebookLeadsThisMonth::find(),
			    'pagination' => [
			        'pageSize' => 31,
			    ],
			]);

			$thisMonthFacebookByWeekday = new ActiveDataProvider([
			    'query' => UvwFacebookLeadsByWeekdayThisMonth::find(),
			    'pagination' => [
			        'pageSize' => 10,
			    ],
			]);

			return $this->render('facebook', [
				
				'fbdaily'=> $thisMonthFacebookByDay,
				'fbweekday'=> $thisMonthFacebookByWeekday
			]);
    	}    	
    }



    private function getProvider($model_type)
    {
    	$dp=false;
		switch ($model_type) {
		    case "Convertible":
				$dp= new ActiveDataProvider([
				    'query' => UvwUnitsConvertible::find(),
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);
		        break;
		    case "Coupe":
				$dp= new ActiveDataProvider([
				    'query' => UvwUnitsCoupe::find(),
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);
		        break;
		    case "Estate":
				$dp= new ActiveDataProvider([
				    'query' => UvwUnitsEstate::find(),
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);
		        break;
		    case "Hatchback":
				$dp= new ActiveDataProvider([
				    'query' => UvwUnitsHatchBack::find(),
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);
		        break;
		    case "MPV":
				$dp= new ActiveDataProvider([
				    'query' => UvwUnitsMPV::find(),
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);
		        break;
		    case "Pickup":
				$dp= new ActiveDataProvider([
				    'query' => UvwUnitsPickups::find(),
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);
		        break;
		    case "SUV":
				$dp= new ActiveDataProvider([
				    'query' => UvwUnitsSUV::find(),
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);
		        break;
		    case "Saloon":
				$dp= new ActiveDataProvider([
				    'query' => UvwUnitsSaloon::find(),
				    'pagination' => [
				        'pageSize' => 20,
				    ],
				]);
		        break;
		}
		return $dp;    	
    }

}
