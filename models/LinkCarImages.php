<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "link_car_images".
 *
 * @property string $imagename
 * @property string $registration
 * @property int $id
 * @property string $updated_at
 * @property string $created_at
 */
class LinkCarImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'link_car_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['imagename', 'registration'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['imagename'], 'string', 'max' => 55],
            [['registration'], 'string', 'max' => 15],
            [['imagename', 'registration'], 'unique', 'targetAttribute' => ['imagename', 'registration']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'imagename' => 'Imagename',
            'registration' => 'Registration',
            'id' => 'ID',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }
}
