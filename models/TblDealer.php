<?php

namespace app\models;

use Yii;

use yii\db\ActiveRecord;

use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "tbl_dealer".
 *
 * @property int $id UUID
 * @property int $pid Parent ID (if id === pid => Head Office)
 * @property string $name Dealer Name
 * @property string $branchname
 * @property string $address1 Address Line 1
 * @property string $address2 Address Line 2
 * @property string $address3 Address Line 3
 * @property string $city City
 * @property string $postcode Post Code
 * @property string $phone Telephone
 * @property string $mobile Mobile Number
 * @property string $contact_name Contact Name
 * @property string $contact_title Contact Title (Sir/Dr etc)
 * @property string $dealer_web
 * @property string $dealer_email
 * @property string $email_good
 * @property string $outcode PostCode Outcode section
 * @property string $updated_at
 * @property string $created_at
 *
 * @property TblVehicles[] $tblVehicles
 */
class TblDealer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_dealer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pid'], 'integer'],
            [['updated_at', 'created_at'], 'safe'],
            [['name', 'branchname', 'address1', 'address2', 'address3', 'city', 'dealer_web', 'dealer_email','website_provider','dms_provider','dealer_privacy'], 'string', 'max' => 255],
            [['postcode','longitude','latitude'], 'string', 'max' => 10],
            [['postcode','longitude','latitude','city','dealer_web', 'dealer_privacy','district','address1' ], 'required'],
            [['comment'],'string'],
            [['phone', 'mobile','cd_phone_number'], 'string', 'max' => 50],
            [['contact_name'], 'string', 'max' => 100],
            [['contact_title'], 'string', 'max' => 25],
            [['fb_onboard','cardealer','email_good','dealer_fb_page_id','dealer_phone_good','dd_customer','verified'], 'integer' ],
            [['outcode'], 'string', 'max' => 5],
            [['name', 'postcode'], 'unique', 'targetAttribute' => ['name', 'postcode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pid' => 'Pid',
            'name' => 'Name',
            'branchname' => 'Branchname',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'address3' => 'Address3',
            'city' => 'City',
            'postcode' => 'Postcode',
            'phone' => 'Phone',
            'dealer_phone_good'=>'Dealer Phone Verified',
            'cd_phone_number' => 'Car Dealer Tracked Phone Number',
            'mobile' => 'Mobile',
            'contact_name' => 'Contact Name',
            'contact_title' => 'Contact Title',
            'dealer_web' => 'Dealer Web',
            'dealer_email' => 'Dealer Email',
            'cc_email'=>'CC Email for dealers',
            'email_good'=>'Email Verified',
            'outcode' => 'Outcode',
            'longitude'=>'Longitude',
            'latitude'=>'latitude',
            'fb_onboard'=>'Feed Sent to Facebook',
            'cardealer'=>'Active with Car Dealer',
            'dd_customer'=>'DD In Place',
            'dealer_fb_page_id'=>'Dealer Facebook Page ID',
            'website_provider'=>'Website Made By',
            'dms_provider'=>'Dealer Management System Used',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }


/* 

    Time stamp records

*/
    public function behaviors()

    {

        return [

            [

                'class' => TimestampBehavior::className(),

                'attributes' => [

                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],

                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],

                ],
                'value' => function() { return date('c');},

            ],

        ];

    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(TblVehicles::className(), ['did' => 'id'])->orderBy(['make' => SORT_ASC,'model_family'=>SORT_ASC]);
    }

    public function getGMBPosts()
    {
        return $this->hasMany(TblLocalPost::className(), ['did'=>'id'])->orderBy(['created_at'=>SORT_DESC]);
    }
    //Mark comment box
    public function beforeSave($insert)
        {
                if (!parent::beforeSave($insert)) {
                        $this->comment = $this->comment.'<br>'.date('c');
                        return false;
                }else{
                        date_default_timezone_set("Europe/London");
                        $user=  \Yii::$app->user->identity->username;
                        $this->comment = $this->comment.' '.$user. ' edited at '.date('Y-m-d H:i').'<br>';

                }
            return true;
        }
}
