<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uvw_CustomerStock".
 *
 * @property string $Cars Manufacturer
 * @property string $Dealer_family Vehicle Model Group
 * @property int $Units
 */
class UvwCustomerStock extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uvw_CustomerStock';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Cars','StockValue','AverageValue','DaysAgo'], 'integer'],
            [['Dealer', 'LatestStockDate'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Cars' => 'Cars In Stock',
            'Dealer' => 'Dealer Name',
            'StockValue' => 'Forecourt Value',
            'AverageValue'=>'Average Value of Car',
            'DaysAgo' => 'Days Since New Stock',
        ];
    }
}





