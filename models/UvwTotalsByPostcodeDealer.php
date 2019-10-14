<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uvw_TotalsByPostcodeDealer".
 *
 * @property int $Quantity
 * @property string $name Dealer Name
 * @property string $DealerPostCode Post Code
 * @property string $DealerValue
 * @property string $CarMaxValue
 * @property string $CarAverageValue
 */
class UvwTotalsByPostcodeDealer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uvw_TotalsByPostcodeDealer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Quantity'], 'integer'],
            [['DealerValue', 'CarMaxValue', 'CarAverageValue'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['DealerPostCode'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Quantity' => 'Quantity',
            'name' => 'Dealer Name',
            'DealerPostCode' => 'Post Code',
            'DealerValue' => 'Dealer Value',
            'CarMaxValue' => 'Car Max Value',
            'CarAverageValue' => 'Car Average Value',
        ];
    }
}
