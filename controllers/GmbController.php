<?php
namespace app\controllers;
use Yii;

use app\models\TblDealer;
use app\models\TblLocalPost;
use yii\web\Controller;
use yii\authclient\clients\Google;


/**
 * DealerController implements the CRUD actions for TblDealer model.
 */
class GmbController extends Controller
{
	
    /**
     * Default entry.
     * @return mixed
     */
    public function actionIndex()
    {
      // Use the developers console and download your Oauth account
	  // credentials in JSON format. Place them in this directory or
	  // change the key file location if necessary.
		$t=\Yii::getAlias('@app');
	  // Create and configure a new client object.
		$client = new \Google_Client();
	    
	    $KEY_FILE_LOCATION= $t.'/client_secret_379546293519-0fktl60p9v88iq8vpcaps5icg74o11vq.apps.googleusercontent.com-2.json';
	    $client->setApplicationName("Hello Google My Business");
	    $client->setAuthConfig($KEY_FILE_LOCATION);
	    $client->setScopes(['https://www.googleapis.com/auth/business.manage']);
	    $auth_url = $client->createAuthUrl();
// Header re-direct to go to gmb/auth -> this->actionAuth()
	    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
	    die();
    }


    public function actionRocket($did=7319)
    {
    	// Get cars & Insert into Local Posts

    	// Get token & Request access to Location
    	
    	// Upload cars to google my business location
    	$token=$this->getToken();
    	return $token;
    }
/*
Receives Access Token Code for authentication to POST to google my business API
Fetches the Account Name
Fetches the Account Location
*/

    public function actionAuth()
    {

    	$client = new \Google_Client();

    	$client->setAuthConfig(\Yii::getAlias('@app').'/client_secret_379546293519-0fktl60p9v88iq8vpcaps5icg74o11vq.apps.googleusercontent.com-2.json');
    	$client->setApplicationName('Car Dealer Posting');
    	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
// Find the account name
    	$accountname=$this->getAccountno($token);
// Find the location

    	//$location=$this->showLocations($token,$accountname);
    	$location=$this->getLocation($token,$accountname);

    }

    private function getToken()
    {
    	$client = new \Google_Client();
    	$token=false;
    	$client->setAuthConfig(\Yii::getAlias('@app').'/client_secret_379546293519-0fktl60p9v88iq8vpcaps5icg74o11vq.apps.googleusercontent.com-2.json');
    	$client->setApplicationName('Car Dealer Posting');
    	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    	return $token;
    }

/*
	Returns account name for the provided token
*/
	private function getAccountno($token=0)
	{

		$curl = curl_init('https://mybusiness.googleapis.com/v4/accounts/');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token['access_token']));
		curl_setopt_array($curl, array(
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET"

		));

		$response = curl_exec($curl);
		$result=json_decode($response);
		foreach ($result->accounts as $account => $value) {
			$acname=$value->name;
		}
		return $acname;
	}


    private function showLocations($token=0,$accountname='')
    {
		$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$accountname.'/locations/');

		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token['access_token']));
		curl_setopt_array($curl, array(
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET"

		));

		$response = curl_exec($curl);
		
		$result=json_decode($response);

		foreach ($result->locations as $location => $value) {	
			$locid= basename($value->name);
			echo $value->name.' '.$locid .' '.$value->locationName.'</br>';
		}
	}
/*
	Returns the account locations
*/
    private function getLocation($token=0,$accountname='')
    {
		$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$accountname.'/locations/');

		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token['access_token']));
		curl_setopt_array($curl, array(
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET"

		));

		$response = curl_exec($curl);
		
		$result=json_decode($response);

		foreach ($result->locations as $location => $value) {	
			$locid= basename($value->name);
			echo $value->name. '</br>';
		//	$res=$this->processGMB($value->name,$token);

			// echo $value->locationName.' id= '.$locid.'<br/>';
			# Spencers...
			if ($locid=='16502723471430093758'){
					$res=$this->processGMB($value->name,$token);
//				echo 'About to process '.$value->locationN. on Wame.' id= '.$locid.'<br/>';
				// $this->processProducts($value);
			//	 $this->doPosts($value->name,$token);
				// $this->updatePosts($token);
				// $this->deleteSoldPosts($token);
			}
			//Saxton4X4
			if ($locid=='11481587233699700843'){
				$res=$this->processGMB($value->name,$token);

			}

			//vanwise
			if ($locid=='4792337818724182662'){
				$res=$this->processGMB($value->name,$token);

			}


			//EMG Cambridge
			if ($locid=='12531379421733523056'){
				$res=$this->processGMB($value->name,$token);
			}	
			//EMG Thetford
			if ($locid=='9906412623266613288'){
				$res=$this->processGMB($value->name,$token);
			}	
			//EMG Ipswich (Mitsubishi)
			if ($locid=='14143930494576594431'){
				echo 'Ipswich Mitsubishi No longer posting';
				//$res=$this->processGMB($value->name,$token);
			}
			// EMG Ipswich not Mitsubushi
			if ($locid=='315751102911012676'){
				$res=$this->processGMB($value->name,$token);
			}
			// EMG Bury St Edmunds/p
			if ($locid=='4557678430519586161'){
				$res=$this->processGMB($value->name,$token);
			}
			//	EMG Ely
			if ($locid=='15116145361398509972'){
				//die(var_dump($value->name));
				$res=$this->processGMB($value->name,$token);
			}
			// EMG 	Haverhill	
			if ($locid=='9464637363322009510'){
				$res=$this->processGMB($value->name,$token);
			}
			// EMG Kings Lynn
			if ($locid=='8249454250876841011'){
			   $res=$this->processGMB($value->name,$token);
			}
			// EMG Spalding
			if ($locid=='10974974025400830774'){
				$res=$this->processGMB($value->name,$token);
			}
			// EMG Duxford
			if ($locid=='2655556248875119358'){
				$res=$this->processGMB($value->name,$token);
			}
			//	EMG Boston
			if ($locid=='7612439655815053418'){
				$res=$this->processGMB($value->name,$token);
			}
			/*			
			// CarDealer
			if ($locid=='14892738752853776443'){
			//	die(var_dump($value));

			//	$this->clearPricelist($value->name,$token);
			 //	$this->updatePricelist($token);
			 //	$this->processProducts($value);
				// $this->getProducts($value);
			//	$this->getMedia($token,$value->name);
		//	 $this->doPosts($value->name,$token);
			// $this->deleteAllPosts($token);
		//	  echo 'done';
			}
			// EMG Ipswich Mitsubishi

			if ($locid==14143930494576594431){
				//$this->deleteSoldPosts($token);
			//	$this->doPosts($value->name,$token);
			}
			// EMG Bury St Edmunds/p
			if ($locid==4557678430519586161){
				//$this->doPosts($value->name,$token);
				// $this->deleteSoldPosts($token);
			}
//	EMG Ely
			if ($locid==15116145361398509972){
				//die(var_dump($value->name));
				// $this->doPosts($value->name,$token);
			}
// EMG 	Haverhill	
			if ($locid==9464637363322009510){
			//	$this->doPosts($value->name,$token);
			}
// EMG Kings Lynn
			if ($locid==8249454250876841011){
			//	$this->doPosts($value->name,$token);
			}
// EMG Spalding
			if ($locid==10974974025400830774){
			//	$this->doPosts($value->name,$token);
			//	$this->updatePosts($token);
			}
// EMG Duxford
			if ($locid==2655556248875119358){
			//	$this->doPosts($value->name,$token);
			}
// EMG Cambridge 2209648113887269072
			if ($locid==2209648113887269072){
				$this->doPosts($value->name,$token);
			}
			*/
		}
		return ($location);
    }

/*


accounts/106864549308774877963/locations/4557678430519586161
accounts/106864549308774877963/locations/9464637363322009510
accounts/106864549308774877963/locations/16502723471430093758
accounts/106864549308774877963/locations/14892738752853776443
	Posts New Stock to GMB

*/
	private function getProducts($location)
	{
	//	die(var_dump($location));
    	foreach($location->priceLists as $list){
    		die(var_dump(json_encode($list)));
    		foreach ($list->labels as $label => $val) {
    	echo '<h1>'.$location->locationName.'</h1>';
   // this is the products Price List
		    		foreach ($list->sections as $section => $value) {
	// Iterate through the sections
		    		echo '<h2>'.$value->labels[0]->displayName.'</h2><br/>';
		    		//	die(var_dump($value));
		    			foreach ($value->labels as $labeltwo) {
		    				# code...
		    			//	die(var_dump($value->labels[0]->displayName));
		    			}
		    			foreach ($value->items as $subsect => $item) {
	// Iterate through the items
		    				foreach ($item->labels as $lab => $val) {
		    					echo $val->displayName.'<br/>';
		    					echo $val->description.'<br/>';
		    				}
		    				echo $item->price->currencyCode.'<br/>';
		    				echo $item->price->units.'<br/>';
		    				
		    			}
		    		}    				

    	//		}
    		}

    	}		
	}

 /*

 */
 private function getMedia($token,$accountname)
 {
 //	die(var_dump($accountname));

	$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$accountname.'/media/');

	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token['access_token']));
	curl_setopt_array($curl, array(
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_TIMEOUT => 30,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => "GET"

	));

	$response = curl_exec($curl);

	$result=json_decode($response);

	die(var_dump($result));
 	foreach($location->media as $meeja){
 		die(var_dump($meeja));
 	}
 }


private function processGMB($location=0,$token=0){
/*
Find customer based on GMB location_id found in tbl_dealer
Select posts based on the dealer id returned.
1- Delete posts of status 3
2- Update posts of status 2
3- Insert posts of status 1
*/

	$r_sold=$r_changed=$r_new='';

	if ($location){
		$locid= basename($location);
		$dealer =TblDealer::find()->where(['gmb_locationid'=>$locid])->one();
		//die(var_dump($locid));]

		if ($dealer){

			echo 'Processing '.$dealer->name.'<br/>'; ;
/*
			$solds=TblLocalPost::find()->where('status=3')->andwhere(['dealer_id'=>$dealer->id])->all();
			//die(var_dump($solds));
			$this->removeSold($solds,$token);

			$changes=TblLocalPost::find()->where('status=2')->andwhere(['dealer_id'=>$dealer->id])->all();
		//	$this->updateImages($changes,$token,$location);


*/
			$new=TblLocalPost::find()->where('status=1')->andWhere(['gmbpostname' => null])->andwhere(['dealer_id'=>$dealer->id])->all();
			$this->insertNew($new,$token,$location);
		}
	}
	
	return "Finished";
}

private function removeSold($solds,$token){
	if ($solds){
		foreach ($solds as $sold) {
			# code...
			$this->deletePost($sold,$token);
		}
	}
	return $res;
}


private function updateImages($changes,$token,$location){
	foreach ($changes as $change) {
		# code...
		$this->setPost($token,$change,'PATCH',$location);
	}


}

private function insertNew($new,$token,$location){
	foreach ($new as $newone) {
		# code...
		//die(var_dump($newone));
		//die(var_dump('insert new'.$location));
		$this->setPost($token,$newone,'POST',$location);
	//	die(var_dump('done'));
	}	
}

//delete this post
private function deletePost($post,$token){
		$stat='Initialised Delete';
		if ($token&&$post){
			$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$post->gmbpostname);

			curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                  
				'Authorization: Bearer ' . $token['access_token'])                                                                       
				);  

			curl_setopt_array($curl, array(
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_SSL_VERIFYPEER => false,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "DELETE"

			));
	              
			$response = curl_exec($curl);
			if (curl_errno($curl)) {
			    $error_msg = curl_error($curl);
			}
			curl_close($curl);

			if (isset($error_msg)) {
	    // TODO - Handle cURL error accordingly
			    print_r($error_msg);
			    $stat=$error_msg;
			}else{
				$post->status=4;
				$post->save();
				$stat='Deleted Post';
			}

		}
		return $stat;
}


// accepts token,post and action
private function setPost($token,$post,$action,$ac){
	
		if ($token&&$post&&$action){
			$options=$this->getoptions($post);
			$data_string = json_encode($options);

			if ($action=='POST'){
				// New Post
					$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$ac.'/localPosts/');
			}else{
				// Update Existing Post
					$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$post->gmbpostname.'?updateMask=media');

			}

			curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                  
				'Content-Length: ' . strlen($data_string),
				'Authorization: Bearer ' . $token['access_token'])                                                                       
				);  
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 
			curl_setopt_array($curl, array(
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_SSL_VERIFYPEER => false,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => $action

			));
			

			$response = curl_exec($curl);

			$result=json_decode($response);

			$post->gmbpostname=$result->name;
			$post->status=2;
			$post->save(false);		

			return 'OK';
		}

		return 'Not OK';
}


/*
Push un processed Posts to GMB
*/
private function doPosts($ac,$token){

	//$posts = TblLocalPost::find()->where('status=1')->andWhere(['gmbpostname' => null])->andwhere(['dealer_id'=>14451])->all();
	// Just Spencers cars
	$posts = TblLocalPost::find()->where('status=1')->andWhere(['gmbpostname' => null])->andwhere(['dealer_id'=>7319])->all();

	foreach($posts as $post){

		$options=$this->getoptions($post);
		$data_string = json_encode($options);
		$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$ac.'/localPosts/');

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                  
			'Content-Length: ' . strlen($data_string),
			'Authorization: Bearer ' . $token['access_token'])                                                                       
			);  

		curl_setopt_array($curl, array(
		//  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST"

		));
              
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 		
		$response = curl_exec($curl);
		$result=json_decode($response);
		$post->gmbpostname=$result->name;
		$post->status=2;
		$post->save();
//	die(var_dump(basename($result->name)));
//die(var_dump($response));
	}
}

private function setSummary($post){
	$options=array('summary'=> 'For Sale 2');
	return $options;
}

//accounts/106864549308774877963/locations/14892738752853776443/localPosts/8755799247463323154
     /*
		Arrange the data in a templated style dependant on post type.
    */
    private function getOptions($post){

    		switch($post->post_type){

    			case 'LEARN_MORE':
	    	   		$options = 
					array('languageCode' => 'en-US', 
							'summary'=> $post->vehicle->make.' '.$post->vehicle->model.' '.$post->vehicle->year.' for sale in '.$post->dealer->city.' at '.$post->dealer->name.' '.$post->summary, 
							'callToAction'=>array(
								'actionType'=>'LEARN_MORE',
								'url'=>$post->cta_url,
							),
							'media'=>array(
								'mediaFormat'=>'PHOTO',
								'sourceUrl'=>$post->vehicle->default_image,
							));

    				break;
    			case 'EVENT':
    			// Preamble - setting up the data from the Local Posts Table
						$start_time=explode(':',$post->start_time);
						$start_hour=$start_time[0];
						$end_time=explode(':',$post->end_time);
						$startyr=date('Y',strtotime($post->start_date));
						$startmnth=date('m',strtotime($post->start_date));
						$startday=date('d',strtotime($post->start_date));

						$endyr=date('Y',strtotime($post->end_date));
						$endmnth=date('m',strtotime($post->end_date));
						$endday=date('d',strtotime($post->end_date));
						$end_hour=$end_time[0];

		    	   		$options = 
							array('languageCode' => 'en-UK', 
								'summary'=> $post->summary. '@'. $post->dealer->name, 
								'event' => array('title'=>$post->event_title,
									'schedule'=>array(
								        'startDate'=> array(
								            'year'=> $startyr,
								            'month'=> $startmnth,
								            'day'=> $startday,
								          ),
								          'startTime'=> array(
								              'hours'=> $start_hour,
								              'minutes'=> 0,
								              'seconds'=> 0,
								              'nanos'=> 0,
								          ),
								          'endDate'=> array(
								            'year'=> $endyr,
								            'month'=> $endmnth,
								            'day'=> $endday,
								          ),
								          'endTime'=> array(
								              'hours'=> $end_hour,
								              'minutes'=> 0,
								              'seconds'=> 0,
								              'nanos'=> 0,
								          ),
									)
								),
								'media'=>array(
							  		'mediaFormat'=> "PHOTO",
							      	'sourceUrl' => $post->vehicle->default_image,		
							));
						break;
					case 'SHOP':
	    	   		$options = 
					array('languageCode' => 'en-UK', 
							'summary'=> $post->dealer->name.' presents '.$post->vehicle->make.' '.$post->vehicle->model.'.', 
							'callToAction'=>array(
								'actionType'=>'SHOP',
								'url'=>$post->cta_url,
							),
							'media'=>array(
								'mediaFormat'=>'PHOTO',
								'sourceUrl'=>$post->vehicle->default_image,
							));

    				break;						
					//	die(var_dump($options)); 			

    		}
    		return $options;
    }


    private function clearPricelist($ac,$token)
    {


    	$curl=curl_init('https://mybusiness.googleapis.com/v4/'.$ac.'?updateMask=priceLists');
		$data_string=$this->getData();
		curl_setopt_array($curl, array(
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "PATCH"

		));
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                                
				'Content-Length: ' . strlen($data_string),
				'Authorization: Bearer ' . $token['access_token'])                                                                       
			);                
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 
		// Execute cURL session and store the response in $response
		$response = curl_exec($curl);

		$result=json_decode($response);
		die(var_dump($response));
    }
    
    /*
		Clear out price list - currently not required as API does not support posting price lists
    */

    private function getData(){
    	return'';
    }


/* Delete all Local Posts

*/

	private function deleteAllPosts($token)
{
	$posts = TblLocalPost::find()->all();
	foreach($posts as $post){
//		die(var_dump($post->gmbpostname));
		$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$post->gmbpostname);

		curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                  
			'Authorization: Bearer ' . $token['access_token'])                                                                       
			);  

		curl_setopt_array($curl, array(
		//  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "DELETE"

		));
              
		$response = curl_exec($curl);
//	die(var_dump($response));
		$post->status=4;
		$post->gmbpostname='deleted';
		$post->save();

	}
}

/*
	Delete all status 3 posts (sold cars) from Google My Business

*/
    
    private function deleteSoldPosts($token)
	{
		$posts = TblLocalPost::find()->where('status=3')->all();
	//	die(var_dump($posts));
		foreach($posts as $post){
			//die(var_dump($post->gmbpostname));
			$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$post->gmbpostname);

			curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                  
				'Authorization: Bearer ' . $token['access_token'])                                                                       
				);  

			curl_setopt_array($curl, array(
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_SSL_VERIFYPEER => false,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "DELETE"

			));
	              
			$response = curl_exec($curl);
			if (curl_errno($curl)) {
			    $error_msg = curl_error($curl);
			}
			curl_close($curl);

			if (isset($error_msg)) {
			    // TODO - Handle cURL error accordingly
			    print_r($error_msg);
			}
			$twerp = json_decode($response);
		//	die(var_dump($twerp->error->code));
			if ($response->error->code==404){
				die(var_dump('hand job'));
			}
			$post->status=4;
			//$post->gmbpostname='deleted';
			$post->save();
		}

	}

/*
	Delete all status 3 posts (sold cars) from Google My Business

*/
    
    private function updatePosts($token)
	{
		$posts = TblLocalPost::find()->where('status=5')->all();

		foreach($posts as $post){
		//die(var_dump($post->gmbpostname));
			$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$post->gmbpostname.'?updateMask=media');
			$options=$this->getOptions($post);
			$data_string = json_encode($options);

			curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                                                                                       
				'Content-Type: application/json',                                                                  
				'Content-Length: ' . strlen($data_string),
				'Authorization: Bearer ' . $token['access_token'])                                                               
				);  

			curl_setopt_array($curl, array(
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_SSL_VERIFYPEER => false,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => 'PATCH'

			));
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 
			$response = curl_exec($curl);

			if (curl_errno($curl)) {
			    $error_msg = curl_error($curl);
			}
			curl_close($curl);

			if (isset($error_msg)) {
			    // TODO - Handle cURL error accordingly
			    print_r($error_msg);
			}
			$twerp = json_decode($response);

			if ($response->error->code==404){
				die(var_dump('hand job'));
			}
			$post->status=2;
			$post->save();

		}

	}



    private function updatePricelist($token)
    {
    	$curl=curl_init('https://mybusiness.googleapis.com/v4/accounts/117712427212927644134/locations/14892738752853776443?updateMask=priceLists');
		$data_string=$this->testPriceList();
		curl_setopt_array($curl, array(
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "PATCH"

		));
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',                                                                               
			'Content-Length: ' . strlen($data_string),
			'Authorization: Bearer ' . $token['access_token'])                                                                       
		);                
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string); 
		// Execute cURL session and store the response in $response
		$response = curl_exec($curl);
		$result=json_decode($response);
		die(var_dump($response));
    }
/*
	Return amended priceList Object

*/
	private function testPriceList()
	{
		$a='"{"priceListId":"880f062c-f0db-4de8-9e4c-cbe34c6b4092","labels":[{"displayName":"Products"}],"sections":[{"sectionId":"28c3e7de-436c-47b0-aba7-30d86b96c572","labels":[{"displayName":"Hatchbacks"}],"items":[{"itemId":"e41bebf9-3292-4a6f-9fd4-b2d4bd709344","labels":[{"displayName":"Abarth 500cc"}],"price":{"currencyCode":"GBP","units":"3599"}}]},{"sectionId":"3f6958bf-5264-4560-bc11-e08adafc4d3f","labels":[{"displayName":"Saloons"}],"items":[{"itemId":"0eaebc66-f270-47d8-9e89-f0df8a97d975","labels":[{"displayName":"Volkswagen Passat"}],"price":{"currencyCode":"GBP","units":"3300"}}]}]}"';
	//die(var_dump($a));
		return $a;
	}

}