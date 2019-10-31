<?php

namespace app\controllers;

use Yii;

use app\models\TblDealer;
use app\models\SearchLiveDealer;
use app\models\SearchDealerTotals;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use Illuminate\Support\Facades\DB;
use yii\db\Query;


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



/**
 * DealerController implements the CRUD actions for TblDealer model.
 */
class DealerController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TblDealer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchLiveDealer();
    	$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
    	$dataProvider->pagination = ['pageSize' => 100];

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
    	}else{
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        	]);
    	}
    }

    /**
     * Displays a single TblDealer model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TblDealer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblDealer();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblDealer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
    	}else{
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblDealer model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        if (Yii::$app->user->isGuest) {
            return $this->goHome();
    	}else{
            $this->findModel($id)->delete();
		}
            return $this->redirect(['index']);
    }

    public function actionMap()
    {
    
	    if (Yii::$app->user->isGuest){
	    	return $this->goHome();
	    }else{
		$coord = new LatLng(['lat' => 52.658092, 'lng' => -1.120892]);
		$map = new Map([
		    'center' => $coord,
		    'zoom' => 7,
		    'width'=>'100%',
		    'height'=>'800'
		]);

		$dealers=TblDealer::find()->all();//where(['fb_onboard'=>1,'cardealer'=>1])->all();
		foreach($dealers as $dealer){
			$vc=$dealer->vehicle_count;
	/*
			$vehicles=$dealer->vehicles;
			$vc=0;
			foreach($vehicles as $vehicle){
		 	    if ($vehicle->has_images){
			    	$vc++;
			    }	    
			}
			*/
			$coord=new LatLng(['lat'=>$dealer->latitude,'lng'=>$dealer->longitude]);		
			$marker=new Marker([
				'position'=>$coord,
				'title'=>$dealer->name]);
			$marker->attachInfoWindow(
    				new InfoWindow([
        				'content' => '<p>'.$dealer->name.'</p><p>'.$vc.' Vehicles</p>'
    				])
				);	
			$map->addOverlay($marker);
		}
	       return $this->render('facebook',['dealers'=>$dealers,'map'=>$map]); 
	    }
    }


    public function actionThisday()
    {
            if (Yii::$app->user->isGuest){
                return $this->goHome();
            }else{
            $coord = new LatLng(['lat' => 52.658092, 'lng' => -1.120892]);
            $map = new Map([
                'center' => $coord,
                'zoom' => 7,
                'width'=>'100%',
                'height'=>'800'
            ]);

            $dealers=\DB::table('tbl_fb_leads')
                ->join('tbl_vehicles', 'tbl_fb_leads.vehicle_id', '=', 'tbl_vehicles.id')
                ->join('tbl_dealer', 'tbl_vehicles.did', '=', 'tbl_dealer.id')
                ->select('tbl_dealer_name','tbl_dealer.longitude','tbl_dealer.latitude')
                ->where('tbl_fb_leads.ceeated_time','=', curdate())
                ->get();

            foreach($dealers as $dealer){
                $vehicles=$dealer->vehicles;
                $vc=0;
                foreach($vehicles as $vehicle){
                    if ($vehicle->has_images){
                        $vc++;
                    }       
                }
                $coord=new LatLng(['lat'=>$dealer->latitude,'lng'=>$dealer->longitude]);        
                $marker=new Marker([
                    'position'=>$coord,
                    'title'=>$dealer->name]);
                $marker->attachInfoWindow(
                        new InfoWindow([
                            'content' => '<p>'.$dealer->name.'</p><p>'.$vc.' Vehicles</p>'
                        ])
                    );  
                $map->addOverlay($marker);
            }
            return $this->render('facebook',['dealers'=>$dealers,'map'=>$map]);
        }
    }


    public function actionFacebooked()
    {
	    if (Yii::$app->user->isGuest){
	    	return $this->goHome();
	    }else{
		$coord = new LatLng(['lat' => 52.658092, 'lng' => -1.120892]);
		$map = new Map([
		    'center' => $coord,
		    'zoom' => 7,
		    'width'=>'100%',
		    'height'=>'800'
		]);

		$dealers=TblDealer::find()->where(['fb_onboard'=>1,'cardealer'=>1])->all();
		foreach($dealers as $dealer){
			$vehicles=$dealer->vehicles;
			$vc=0;
			foreach($vehicles as $vehicle){
		 	    if ($vehicle->has_images){
			    	$vc++;
			    }	    
			}
			$coord=new LatLng(['lat'=>$dealer->latitude,'lng'=>$dealer->longitude]);		
			$marker=new Marker([
				'position'=>$coord,
				'title'=>$dealer->name]);
			$marker->attachInfoWindow(
    				new InfoWindow([
        				'content' => '<p>'.$dealer->name.'</p><p>'.$vc.' Vehicles</p>'
    				])
				);	
			$map->addOverlay($marker);
		}
	       return $this->render('facebook',['dealers'=>$dealers,'map'=>$map]); 
	    }
    }

    /**
     * Finds the TblDealer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblDealer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblDealer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
