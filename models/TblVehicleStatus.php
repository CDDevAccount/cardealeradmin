<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_vehicle_status".
 *
 * @property int $id UUID
 * @property string $status Vehicle Status
 * @property string $created_at
 * @property string $amended_at
 *
 * @property TblVehicles[] $tblVehicles
 */
class TblVehicleStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_vehicle_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['created_at', 'amended_at'], 'safe'],
            [['status'], 'string', 'max' => 50],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'amended_at' => 'Amended At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTblVehicles()
    {
        return $this->hasMany(TblVehicles::className(), ['status' => 'id']);
    }
}
