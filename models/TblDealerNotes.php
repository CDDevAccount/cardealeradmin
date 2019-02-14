<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_dealer_notes".
 *
 * @property int $id UUID
 * @property int $did Dealer ID
 * @property string $note Note
 * @property string $created_at Created At
 * @property string $updated_at Last Changed At
 */
class TblDealerNotes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_dealer_notes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['did'], 'required'],
            [['did'], 'integer'],
            [['note'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'did' => 'Did',
            'note' => 'Note',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
