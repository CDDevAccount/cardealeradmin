<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_local_post".
 *
 * @property int $id
 * @property int $dealer_id
 * @property int $vehicle_id
 * @property string $created_at
 * @property string $amended_at
 * @property string $local_id
 * @property string $post_type
 * @property string $start_date
 * @property string $end_date
 * @property string $start_time
 * @property string $end_time
 * @property string $summary
 * @property string $event_title
 * @property string $action_type
 * @property string $image_url
 * @property string $postname
 * @property string $cta_url
 * @property string $gmbpostname
 * @property int $status
 *
 * @property TblDealer $dealer
 */
class TblLocalPost extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_local_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['dealer_id', 'vehicle_id', 'status'], 'integer'],
            [['created_at', 'amended_at', 'start_date', 'end_date', 'start_time', 'end_time'], 'safe'],
            [['summary'], 'required'],
            [['local_id', 'action_type', 'gmbpostname'], 'string', 'max' => 100],
            [['post_type'], 'string', 'max' => 10],
            [['summary'], 'string', 'max' => 500],
            [['event_title', 'cta_url'], 'string', 'max' => 255],
            [['image_url', 'postname'], 'string', 'max' => 250],
            [['dealer_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblDealer::className(), 'targetAttribute' => ['dealer_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dealer_id' => 'Dealer ID',
            'vehicle_id' => 'Vehicle ID',
            'created_at' => 'Created At',
            'amended_at' => 'Amended At',
            'local_id' => 'Local ID',
            'post_type' => 'Post Type',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'summary' => 'Summary',
            'event_title' => 'Event Title',
            'action_type' => 'Action Type',
            'image_url' => 'Image Url',
            'postname' => 'Postname',
            'cta_url' => 'Cta Url',
            'gmbpostname' => 'Gmbpostname',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDealer()
    {
        return $this->hasOne(TblDealer::className(), ['id' => 'dealer_id']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(TblVehicles::className(), ['id' => 'vehicle_id']);
    }
}
