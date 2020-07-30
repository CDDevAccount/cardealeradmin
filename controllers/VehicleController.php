<?php

namespace app\controllers;

use Yii;
use app\models\TblVehicles;
use app\models\LinkCarImages;
use app\models\SearchVehicles;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
/**
 * VehicleController implements the CRUD actions for TblVehicles model.
 */
class VehicleController extends Controller
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
     * Lists all TblVehicles models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }else{
            $searchModel = new SearchVehicles();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single TblVehicles model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }else{
            $i=0;
            $imageurls= array();
            $baseurl='https://media.cardealer.co.uk';
           
            $model=$this->findModel($id);
            $reg=$model->registration;
            //var_dump($model->registration);
            $images=LinkCarImages::find()->where(['registration'=>$model->registration])->all();
            if (is_array($images)){
                foreach ($images as $image){
                    //var_dump($image->imagename);
                    $imageurls[$i] = $baseurl.'/'.$reg.'/'.$image->imagename;
                    $i++;
                }
                
            }else{
                $imageurls=false;
            }
         //   var_dump($pubimages);
            return $this->render('view', [
                'model' => $model, //$this->findModel($id),
                'images' =>$imageurls,
                'imagemodels'=>$images,
            ]);
        }
    }


    public function actionCarimages($reg='')
    {
        if ($reg>''){
            $query=LinkCarImages::find()->where(['registration'=>$reg]);
            $provider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                'pageSize' => 10,
                ],
                'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                    'imagename' => SORT_ASC, 
                ]
                ],
            ]);

            return $this->render('carimages', [
            //    'searchModel' => $searchModel,
                'dataProvider' => $provider,
            ]);            
        }
    }

    /**
     * Creates a new TblVehicles model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }else{
            $model = new TblVehicles();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
         }
    }

    /**
     * Updates an existing TblVehicles model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }else{
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing TblVehicles model.
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

        return $this->redirect(['index']);
        }
    }

    /**
     * Finds the TblVehicles model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TblVehicles the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblVehicles::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
