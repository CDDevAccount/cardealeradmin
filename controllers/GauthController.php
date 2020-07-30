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
class GauthController extends Controller
{
	
    /**
     * Default entry.
     * @return mixed
     */
    public function actionIndex()
    {


    	//echo $this->getData();
    	$fred='{"web":{"client_id":"379546293519-0fktl60p9v88iq8vpcaps5icg74o11vq.apps.googleusercontent.com","project_id":"cdmapi","auth_uri":"https://accounts.google.com/o/oauth2/auth","token_uri":"https://oauth2.googleapis.com/token","auth_provider_x509_cert_url":"https://www.googleapis.com/oauth2/v1/certs","client_secret":"fCo8HdoUBUUkhlp7NcyaZpqn","redirect_uris":["http://localhost:8000/openauth2/callback","https://developers.google.com/oauthplayground"]}}';
$arr = array('languageCode' => 'en-UK', 
	'summary'=> 'API POST event!', 
	'event' => array('title'=>'Test Title',
					'schedule'=>array(
				        'startDate'=> array(
				            'year'=> 2020,
				            'month'=> 2,
				            'day'=> 28,
				          ),
				          'startTime'=> array(
				              'hours'=> 9,
				              'minutes'=> 0,
				              'seconds'=> 0,
				              'nanos'=> 0,
				          ),
				          'endDate'=> array(
				            'year'=> 2020,
				            'month'=> 10,
				            'day'=> 31,
				          ),
				          'endTime'=> array(
				              'hours'=> 17,
				              'minutes'=> 0,
				              'seconds'=> 0,
				              'nanos'=> 0,
				          ),
					)
				),
	'media'=>array(
  		'mediaFormat'=> "PHOTO",
      	'sourceUrl' => "https://media.cardealer.co.uk/HY66VZC/1.jpg",		
	));

//$post = TblLocalPost::find()->where(['id'=>1])->one();
// die(var_dump(date('Y',strtotime($post->start_date))));
// $start_time=explode(':',$post->start_time);
//$start_hour=$start_time[0];
//die(var_dump($start_hour));
// die(var_dump(explode(':',$post->start_time)));
//echo json_encode($arr);
//stop;

		//$this->getAC();
			//stop;

    	$this->initializeMybusiness();
    	//echo json_decode($fred);

    }


function initializeMybusiness()
{
  // Creates and returns the Analytics Reporting service object.

  // Use the developers console and download your service account
  // credentials in JSON format. Place them in this directory or
  // change the key file location if necessary.
	$t=\Yii::getAlias('@app');
	putenv('GOOGLE_APPLICATION_CREDENTIALS='.$t.'/client_credentials.json');
  // Create and configure a new client object.
	$client = new \Google_Client();
	// $client->useApplicationDefaultCredentials();



    
    $KEY_FILE_LOCATION= $t.'/client_secret_3795.json';
    $client->setApplicationName("Hello Google My Business");
    $client->setAuthConfig($KEY_FILE_LOCATION);
    $client->setDeveloperKey("AIzaSyBFc6nb2XH8V2XafIFcSd3U9gs6KjFnW8A");
    $client->setScopes(['https://www.googleapis.com/auth/business.manage']);

    $auth_url = $client->createAuthUrl();
//die(var_dump($auth_url));
    header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));

  die(var_dump('here'));
    /*
    $access_token = $client->getAccessToken();
    $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	$client->setRedirectUri($redirect_uri);
	die(var_dump($access_token));
    $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
   // $client->addScope(\Google_Service_Drive::DRIVE);
   // $business = new \Google_Service_MyBusiness($client);
    die(var_dump($auth_url));
    $accounts = $business->accounts->listAccounts()->getAccounts();
    
    echo '<pre>';
var_dump( $accounts );
echo '</pre>';
	$httpClient = $client->authorize();

// make an HTTP request
	$response = $httpClient->get('https://www.googleapis.com/auth/business.manage');
	die(var_dump($response));
	$request=$business->accounts;
	$resultsDeferred=$client->execute($request);

	return $business;
*/
}


public function actionCatch($request)
{
	return $request;
}



private function doPosts($ac,$token){

	$posts = TblLocalPost::find()->all();
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

		//die(var_dump($response));
	}
}

/*
Accepts Code for authentication to POST to google my business API

*/

    public function actionAuth()
    {
// gonna need to move this...
		$posts = TblLocalPost::find()->all();
    	$client = new \Google_Client();
    	//$client->setAuthConfig(\Yii::getAlias('@app').'/client_credentials.json');
    	$client->setAuthConfig(\Yii::getAlias('@app').'/client_secret_3795.json');
    	$client->setApplicationName('Hello from him');
    	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    	$accountname=$this->getAccountno($token);
    	$location=$this->getLocation($token,$accountname);

    	$httpClient = $client->authorize();
	
		if (isset($_GET['code'])) {

    		foreach($posts as $post){

    			$options=$this->getoptions($post);
				$data_string = json_encode($options);
				$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$accountname.'/locations/14892738752853776443/localPosts');
				curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token['access_token']));

				curl_setopt_array($curl, array(
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_SSL_VERIFYPEER => false,
				  CURLOPT_TIMEOUT => 30,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "POST"

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

    		}
		}
    }

    /*
	Check System Account function
    */

	private function getAC()
	{


    	$client = new \Google_Client();
    	putenv('GOOGLE_APPLICATION_CREDENTIALS=/Users/chrismewton/CarDealer/cdmapi-23fb97629f6c.json');
		$client->useApplicationDefaultCredentials();
    //	$client->setAuthConfig(\Yii::getAlias('@app').'/client_credentials.json');
    	$client->setApplicationName('Hello from him');
	    $client->setScopes(['https://www.googleapis.com/auth/business.manage']);
    	$token = $client->refreshTokenWithAssertion();		
		$url='https://mybusiness.googleapis.com/v4/accounts/103977470972380518433/locations';
	//	$curl = curl_init('https://mybusiness.googleapis.com/v4/accounts/103977470972380518433/locations');
		$curl = curl_init('https://mybusiness.googleapis.com/v4/accounts/');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token['access_token']));
		curl_setopt_array($curl, array(
		//  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_SSL_VERIFYPEER => false,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET"

		));

		$response = curl_exec($curl);
		//echo $response->getBody();
		die(var_dump(json_decode($response)));
    	$business = new \Google_Service_MyBusiness($client);
	   	echo $token['access_token'];
		die(var_dump(json_encode($client->refreshTokenWithAssertion())));
	}





/*
	Returns the first location
*/
    private function getLocation($token=0,$accountname='')
    {
		$curl = curl_init('https://mybusiness.googleapis.com/v4/'.$accountname.'/locations/');

		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token['access_token']));
		curl_setopt_array($curl, array(
		//  CURLOPT_URL => $url,
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
			# Spencers...
			if ($value->name=='accounts/117712427212927644134/locations/16502723471430093758'){
				//$this->processProducts($value);

			}
			// CarDealer
			if ($value->name=='accounts/117712427212927644134/locations/14892738752853776443'){
			//	die(var_dump($value));
			//	$this->testPricelist($token);
			 	$this->processProducts($value);
			//	$this->pushProducts($value);
				//$this->doPosts($value->name,$token);

			//	$this->processProducts($value);
			}
		//	echo $value->name.'<br/>';
	//		echo $value->locationName.'<br/>';
	//		echo $value->primaryCategory->displayName.'</br>';
	//:		echo $value->localPosts;			
		}

//		die(var_dump($result));
		return ($location);
    }

/*
	Posts New Stock to GMB

*/
	private function pushProducts($location)
	{
    	foreach($location->priceLists as $list){
    		foreach ($list->labels as $label => $val) {
    			if ($val->displayName=='Products'){
   // this is the products Price List
		    		foreach ($list->sections as $section => $value) {
	// Iterate through the sections
		    			foreach ($value->items as $subsect => $item) {
	// Iterate through the items
		    				foreach ($item->labels as $lab => $val) {
		    				//	echo $val->displayName.'<br/>';
		    				//	echo $val->description.'<br/>';
		    				}
		    				//echo $item->price->currencyCode.'<br/>';
		    				//echo $item->price->units.'<br/>';
		    				//echo $item->media->PHOTO.'photo';
		    				//die(var_dump($item->media));
		    			}
		    		}    				

    			}
    		}

    	}		
	}





/*

*/

    private function processProducts($location)
    {
    	die(var_dump($location->priceLists));
    	foreach($location->priceLists as $list){
    	//	die(var_dump($list));
    		foreach ($list->sections as $section => $value) {
    			echo $section->displayName.'<br/>';
    			foreach ($value->items as $subsect => $item) {
    				# code...
    				foreach ($item->labels as $lab => $val) {
    				//	die(var_dump($lab));
    					echo $val->displayName.'<br/>';
    					echo $val->description.'<br/>';
    					# code...
    				}
    				echo $item->price->currencyCode.'<br/>';
    				echo $item->price->units.'<br/>';
    			}
    		}
    	}
    }

/*
	Returns account name for the provided token
*/
	private function getAccountno($token=0)
	{

		$curl = curl_init('https://mybusiness.googleapis.com/v4/accounts/');
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $token['access_token']));
		curl_setopt_array($curl, array(
		//  CURLOPT_URL => $url,
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
			# code...
			$acname=$value->name;
		}
		return $acname;
	}



    /*
		Arrange the data in a templated style dependant on post type.
    */
    private function getOptions($post){

    		switch($post->post_type){

    			case 'LEARN_MORE':
	    	   		$options = 
					array('languageCode' => 'en-US', 
							'summary'=> $post->dealer->name.' presents '.$post->vehicle->make.' '.$post->vehicle->model.'.', 
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


    private function testPricelist($token)
    {


    	$curl=curl_init('https://mybusiness.googleapis.com/v4/accounts/117712427212927644134/locations/14892738752853776443?updateMask=priceLists');
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


    private function getData()
    {
    	$data= '{
  "priceLists": [
    {

    }
  ]
}';


    	return $data;
    }


    private function deletePriceList()
    {

    }




/*

PATCH
https://mybusiness.googleapis.com/v4/accounts/{accountId}/locations/{locationId}?updateMask=priceLists
 {
  "priceLists": [
    {
      "priceListId": "Breakfast",
      "labels": [
        {
          "displayName": "Breakfast",
          "description": "Tasty Google Breakfast",
          "languageCode": "en"
        }
      ],
      "sourceUrl": "http://www.google.com/todays_menu",
      "sections": [
        {
          "sectionId": "entree_menu",
          "sectionType":"FOOD",
          "labels": [
            {
              "displayName": "Entrées",
              "description": "Breakfast Entrées",
              "languageCode": "en"
            }
          ],
          "items": [
            {
              "itemId": "scramble",
              "labels": [
                {
                  "displayName": "Big Scramble",
                  "description": "A delicious scramble filled with Potatoes, Eggs, 
                  Bell Peppers, and Sausage",
                  "languageCode": "en"
                }
              ],
              "price": {
                "currencyCode": "USD",
                "units": "12",
                "nanos": "200000000"
              }
            },
            {
              "itemId": "steak_omelette",
              "labels": [
                {
                  "displayName": "Steak Omelette",
                  "description": "Three egg omelette with grilled prime rib, 
                   fire-roasted bell peppers and onions, saut\u00e9ed mushrooms
                   and melted Swiss cheese",
                  "languageCode": "en"
                }
              ],
              "price": {
                "currencyCode": "USD",
                "units": "15",
                "nanos": "750000000"
              }
            }
          ]
        }
      ]
    }
  ]
}

 	*/
}