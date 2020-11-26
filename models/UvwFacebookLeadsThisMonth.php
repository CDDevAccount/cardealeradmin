<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "uvw_FacebookLeadsThisMonth".
 *
 * @property int $FacebookLeads
 * @property int $day
 * @property string $Weekday
 */
class UvwFacebookLeadsThisMonth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'uvw_FacebookLeadsThisMonth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FacebookLeads', 'day'], 'integer'],
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
            'day' => 'Day',
            'Weekday' => 'Weekday',
        ];
    }
}
