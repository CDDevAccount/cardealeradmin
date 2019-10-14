<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uvw_CurrentStockFBLeads".
 *
 * @property int $Units
 * @property string $Total
 * @property string $AverageValue
 * @property string $Dealer Dealer Name
 */
class UvwCurrentStockFBLeads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uvw_CurrentStockFBLeads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Units'], 'integer'],
            [['Total', 'AverageValue'], 'number'],
            [['Dealer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Units' => 'Units',
            'Total' => 'Total',
            'AverageValue' => 'Average Value',
            'Dealer' => 'Dealer Name',
        ];
    }
}
