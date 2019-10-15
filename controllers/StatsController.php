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

use app\models\SearchLiveDealer;
use app\models\SearchDealerTotals;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;


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

		$fbleadProvider= new ActiveDataProvider([
		    'query' => UvwCurrentStockFBLeads::find(),
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
                'fbleadProvider'=>$fbleadProvider,
        	]);
    	}
        return $this->render('index');
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
