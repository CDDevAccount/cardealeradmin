<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_local_post_status".
 *
 * @property int $status
 * @property string $status_name
 */
class TblLocalPostStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_local_post_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'integer'],
            [['status_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status' => 'Status',
            'status_name' => 'Status Name',
        ];
    }
}
