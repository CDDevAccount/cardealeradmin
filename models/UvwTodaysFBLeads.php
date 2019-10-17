<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uvw_TodaysFBLeads".
 *
 * @property int $Leads
 * @property string $make Manufacturer
 * @property string $model Model
 * @property string $Total
 * @property string $AverageValue
 * @property string $Dealer Dealer Name
 */
class UvwTodaysFBLeads extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uvw_TodaysFBLeads';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Leads'], 'integer'],
            [['Total', 'AverageValue'], 'number'],
            [['make'], 'string', 'max' => 100],
            [['model', 'Dealer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Leads' => 'Leads',
            'make' => 'Manufacturer',
            'model' => 'Model',
            'Total' => 'Total',
            'AverageValue' => 'Average Value',
            'Dealer' => 'Dealer Name',
        ];
    }
}
