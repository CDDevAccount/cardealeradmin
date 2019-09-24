<?php

namespace app\models;

use Yii;

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
            [['phone', 'mobile'], 'string', 'max' => 50],
            [['contact_name'], 'string', 'max' => 100],
            [['contact_title'], 'string', 'max' => 25],
            [['fb_onboard'], 'integer' ],
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
            'mobile' => 'Mobile',
            'contact_name' => 'Contact Name',
            'contact_title' => 'Contact Title',
            'dealer_web' => 'Dealer Web',
            'dealer_email' => 'Dealer Email',
            'outcode' => 'Outcode',
            'longitude'=>'Longitude',
            'latitude'=>'latitude',
            'website_provider'=>'Website Made By',
            'dms_provider'=>'Dealer Management System Used',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblVehicles()
    {
        return $this->hasMany(TblVehicles::className(), ['did' => 'id']);
    }
}
