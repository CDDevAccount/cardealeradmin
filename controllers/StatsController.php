<?php

namespace app\controllers;

use Yii;
use app\models\TblDealer;
use app\models\TblVehicles;
use app\models\UvwTotalsByPostcodeDealer;
use app\models\UvwCurrentStockFBLeads;

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

}
