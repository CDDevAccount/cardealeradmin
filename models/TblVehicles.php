<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_vehicles".
 *
 * @property int $id UUID
 * @property int $did Dealer ID
 * @property string $make Manufacturer
 * @property string $model Model
 * @property string $colour Colour
 * @property string $fuel_type Fuel Type
 * @property string $year Year of Manufacture
 * @property string $price Price
 * @property string $dealer_description Dealer Description
 * @property string $post_code Post Code
 * @property string $orig_url Originating Url
 * @property string $full_name Name including Make
 * @property int $mileage Mileage
 * @property string $model_type Model type e.g. Hatchback
 * @property string $engine_type Engine Configuration
 * @property string $engine_size Engine size
 * @property string $transmission Transmission system
 * @property int $doors Number of doors
 * @property string $registration Registration
 * @property string $phone Phone Number
 * @property string $images Delimited images
 * @property string $default_image Default Image to use
 * @property string $engine_configuration Engine Configuration
 * @property int $seats Number of Seats
 * @property string $interior_colour Interior Colour
 * @property string $h1_text Main Strap line
 * @property int $status Vehicle Status
 * @property int $detail_check Have the vehicle details been checked
 * @property int $mot_check Has the MOT history been checked
 * @property string $mot_check_date Date MOT history checked
 * @property string $slug Vehicle Slug
 * @property string $model_family Vehicle Model Group
 * @property string $listed_date Listed Date
 * @property int $has_images Are there images with this vehichle
 * @property string $created_at Date loaded
 * @property string $amended_at Date last amended
 *
 * @property TblDealer $d
 * @property TblVehicleStatus $status0
 */
class TblVehicles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_vehicles';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['did', 'mileage', 'doors', 'seats', 'status', 'detail_check', 'mot_check', 'has_images'], 'integer'],
            [['price'], 'number'],
            [['dealer_description', 'images'], 'string'],
            [['mot_check_date', 'listed_date', 'created_at', 'amended_at'], 'safe'],
            [['make', 'default_image', 'model_family'], 'string', 'max' => 100],
            [['model', 'colour', 'orig_url', 'full_name'], 'string', 'max' => 255],
            [['fuel_type', 'model_type', 'transmission', 'phone', 'interior_colour'], 'string', 'max' => 50],
            [['year'], 'string', 'max' => 4],
            [['post_code', 'registration'], 'string', 'max' => 10],
            [['engine_type'], 'string', 'max' => 5],
            [['engine_size', 'engine_configuration'], 'string', 'max' => 20],
            [['h1_text'], 'string', 'max' => 500],
            [['slug'], 'string', 'max' => 400],
            [['registration'], 'unique'],
            [['did'], 'exist', 'skipOnError' => true, 'targetClass' => TblDealer::className(), 'targetAttribute' => ['did' => 'id']],
            [['status'], 'exist', 'skipOnError' => true, 'targetClass' => TblVehicleStatus::className(), 'targetAttribute' => ['status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'did' => 'Did',
            'make' => 'Make',
            'model' => 'Model',
            'colour' => 'Colour',
            'fuel_type' => 'Fuel Type',
            'year' => 'Year',
            'price' => 'Price',
            'dealer_description' => 'Dealer Description',
            'post_code' => 'Post Code',
            'orig_url' => 'Orig Url',
            'full_name' => 'Full Name',
            'mileage' => 'Mileage',
            'model_type' => 'Model Type',
            'engine_type' => 'Engine Type',
            'engine_size' => 'Engine Size',
            'transmission' => 'Transmission',
            'doors' => 'Doors',
            'registration' => 'Registration',
            'phone' => 'Phone',
            'images' => 'Images',
            'default_image' => 'Default Image',
            'engine_configuration' => 'Engine Configuration',
            'seats' => 'Seats',
            'interior_colour' => 'Interior Colour',
            'h1_text' => 'H1 Text',
            'status' => 'Status',
            'detail_check' => 'Detail Check',
            'mot_check' => 'Mot Check',
            'mot_check_date' => 'Mot Check Date',
            'slug' => 'Slug',
            'model_family' => 'Model Family',
            'listed_date' => 'Listed Date',
            'has_images' => 'Has Images',
            'created_at' => 'Created At',
            'amended_at' => 'Amended At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getD()
    {
        return $this->hasOne(TblDealer::className(), ['id' => 'did']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus0()
    {
        return $this->hasOne(TblVehicleStatus::className(), ['id' => 'status']);
    }
}
