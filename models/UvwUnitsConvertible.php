<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uvw_UnitsConvertible".
 *
 * @property string $make Manufacturer
 * @property string $model_family Vehicle Model Group
 * @property int $Units
 */
class UvwUnitsConvertible extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uvw_UnitsConvertible';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Units'], 'integer'],
            [['make', 'model_family'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'make' => 'Manufacturer',
            'model_family' => 'Vehicle Model Group',
            'Units' => 'Units',
        ];
    }
}
