<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_towns".
 *
 * @property int $id
 * @property string $town
 * @property string $outcode Town Centre OutCode
 * @property string $town_slug TownUrl
 * @property string $longitude Mean Longitude
 * @property string $latitude Mean Latitude
 */
class TblTowns extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_towns';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['town'], 'string', 'max' => 50],
            [['outcode'], 'string', 'max' => 5],
            [['town_slug'], 'string', 'max' => 255],
            [['longitude', 'latitude'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'town' => 'Town',
            'outcode' => 'Outcode',
            'town_slug' => 'Town Slug',
            'longitude' => 'Longitude',
            'latitude' => 'Latitude',
        ];
    }
}
