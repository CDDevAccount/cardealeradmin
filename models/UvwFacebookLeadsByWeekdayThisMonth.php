<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uvw_FacebookLeadsByWeekdayThisMonth".
 *
 * @property int $FacebookLeads
 * @property string $Weekday
 */
class UvwFacebookLeadsByWeekdayThisMonth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uvw_FacebookLeadsByWeekdayThisMonth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FacebookLeads'], 'integer'],
            [['Weekday'], 'string', 'max' => 9],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FacebookLeads' => 'Facebook Leads',
            'Weekday' => 'Weekday',
        ];
    }
}
