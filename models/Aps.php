<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "aps".
 *
 * @property int $id
 * @property string $mac
 * @property int $place_id
 */
class Aps extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mac', 'place_id'], 'required'],
            [['place_id'], 'integer'],
            [['mac'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'mac' => 'Mac',
            'place_id' => 'Place ID',
        ];
    }
}
