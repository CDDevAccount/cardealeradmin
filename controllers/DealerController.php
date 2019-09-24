<?php

namespace app\controllers;

use Yii;
use app\models\TblDealer;
use app\models\SearchDealer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
        $searchModel = new SearchDealer();
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
        ]);}
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
