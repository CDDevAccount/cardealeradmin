<?php

namespace app\controllers;

use Yii;
use app\models\LinkCarImages;
use app\models\TblVehicles;
use app\models\Searchimages;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ImagesController implements the CRUD actions for LinkCarImages model.
 */
class ImagesController extends Controller
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
     * Lists all LinkCarImages models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new Searchimages();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LinkCarImages model.
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
     * Creates a new LinkCarImages model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LinkCarImages();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LinkCarImages model.
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

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LinkCarImages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionPromoReg($reg)
    {

        $ceramic=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/2.jpg'));
        $warranty=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/1.jpg'));
        $googlereview=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/3.jpg'));
        $lost=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/4.jpg'));
        $inspak=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/5.jpg'));
//die(var_dump($ceramic));
      //  $cars=TblVehicles::find()->where('did=7313')->andWhere('has_images=1')->andWhere(['registration' => 'BP15FWO'])->all();
        $car=TblVehicles::find()->where(['registration'=>$reg])->all(); 
        $images=LinkCarImages::find()->where(['registration'=>$reg])->all();       
        foreach ($images as $key => $image) {

            $testurl='https://media.cardealer.co.uk/'.$reg.'/'.$image->imagename;
            if ($image->imagename=='5.jpg') echo md5(file_get_contents($testurl)).' '.$ceramic;
            try {file_get_contents($testurl);
                $mdimage=md5(file_get_contents($testurl));
               // die(var_dump($testurl));
                 //  die(var_dump('here'));
                switch ($mdimage) {
                    case $ceramic:
                        echo "$testurl is Ceramic<br/>";
                        $image->advert=1;
                        break;
                    case $warranty:
                        echo "$testurl is Warranty<br/>";
                        $image->advert=1;
                        break;
                    case $googlereview:
                      echo "$testurl is GoogleReview<br/>";
                        $image->advert=1;
                        break;
                    case $lost:
                        echo "$testurl is How to find us<br/>";
                        $image->advert=1;
                        break;
                    case $inspak:
                       echo "$testurl is Insurance Blurb<br/>";
                        $image->advert=1;
                        break;
                    default:

                        break;
                }
                $image->save();


            }
            catch (Exception $e){
                echo 'Message' .$e.Message;
            }

        }
        return 'Processed';
    }

    public function actionPromoImages()
    {
       // return 'stop';

        $ceramic=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/2.jpg'));
        $warranty=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/1.jpg'));
        $googlereview=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/3.jpg'));
        $lost=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/4.jpg'));
        $inspak=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/5.jpg'));
//die(var_dump($ceramic));
      //  $cars=TblVehicles::find()->where('did=7313')->andWhere('has_images=1')->andWhere(['registration' => 'BP15FWO'])->all();
        $cars=TblVehicles::find()->where('did=7319')->andWhere('has_images=1')->all();
       // die(var_dump($cars));
        foreach ($cars as $item => $car) {
            # code...
            $reg=$car->registration;
            echo $reg.'<br/>';
            $images=LinkCarImages::find()->where(['registration'=>$reg])->all();
            $default=$car->default_image;
            $second=$car->second_image;

            $i=0;
            $def1=$def2='unset';
     
            foreach ($images as $key => $image) {
                $testurl='https://media.cardealer.co.uk/'.$reg.'/'.$image->imagename;
                try {file_get_contents($testurl);
                    $mdimage=md5(file_get_contents($testurl));
                   // die(var_dump($testurl));
                    switch ($mdimage) {
                        case $ceramic:
                      //      echo "$testurl is Ceramic<br/>";
                            $image->advert=1;
                            break;
                        case $warranty:
                     //       echo "$testurl is Warranty<br/>";
                            $image->advert=1;
                            break;
                        case $googlereview:
                      //      echo "$testurl is GoogleReview<br/>";
                            $image->advert=1;
                            break;
                        case $lost:
                      //      echo "$testurl is How to find us<br/>";
                            $image->advert=1;
                            break;
                        case $inspak:
                       //     echo "$testurl is Insurance Blurb<br/>";
                            $image->advert=1;
                            break;
                        default:

                            break;
                    }
                    $image->save();


                }
                catch (Exception $e){
                    echo 'Message' .$e.Message;
                }

            }

            
        }
       // die(var_dump($cars));
    }

    private function curl_file($your_url)
    {
     //   die(var_dump('here'));
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $your_url);
        curl_setopt($ch, CURLOPT_FAILONERROR, true); // Required for HTTP error codes to be reported via our call to curl_error($ch)
        //...
        $response=curl_exec($ch);
       // die(var_dump($response));
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }
        

        if (isset($error_msg)) {
            // TODO - Handle cURL error accordingly
            die(var_dump($error_msg));
            return false;
        }else{
              switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
                case 200:  # OK
                $ans=1;
                  break;
                default:
                  echo 'Unexpected HTTP code: ', $http_code, "\n";
                  $ans=0;
              }

        }
        curl_close($ch);
        return $ans;
    }

    public function actionMarkImage()
    {
        /*
Spencers holding images
        */
        $ceramic=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/2.jpg'));
        $warranty=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/1.jpg'));
        $googlereview=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/3.jpg'));
        $lost=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/4.jpg'));
        $inspak=md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/5.jpg'));

        $md5image1 = md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/1.jpg'));
        $md5image2 = md5(file_get_contents('https://media.cardealer.co.uk/BP15FWO/2.jpg'));
        if ($md5image1 == $md5image2) {
            die(var_dump('same'));
        }
        // Load the image
        $image = imagecreatefromstring(file_get_contents('https://media.cardealer.co.uk/YG65RMV/6040629845505864025.png'));
         
        $w = imagesx($image);
        $h = imagesy($image);
         
        // Load the watermark
        $watermark1 = imagecreatefrompng('CDWatermark.png');
        $watermark=imagescale($watermark1,$w,$h);
        $watermark=$watermark1;
        $ww = imagesx($watermark);
        $wh = imagesy($watermark);
         
        // Insert watermark to the right bottom corner
        imagecopy($image, $watermark, 0, 0, 0, 0, $ww, $wh);
         
        // ... or to the image center
        // imagecopy($image, $watermark, (($w/2)-($ww/2)), (($h/2)-($wh/2)), 0, 0, $ww, $wh);
         
        // Send the image
        header('Content-type: image/jpeg');
        imagejpeg($image,null,95);
        exit();


        die(var_dump("here"));
    }

    /**
     * Finds the LinkCarImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LinkCarImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LinkCarImages::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
