<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "smsc".
 *
 * @property int $id
 * @property string $mac
 * @property int $code
 * @property string $ap_mac
 * @property int $status
 * @property string $time
 *@property string $ip
 */
class Smsc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'smsc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['mac', 'code', 'ap_mac'], 'required'],
            [['code', 'status'], 'integer'],
            [['time'], 'safe'],
            [['mac', 'ap_mac', 'ip'], 'string', 'max' => 100],
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
            'code' => 'Code',
            'ap_mac' => 'Ap Mac',
            'status' => 'Status',
            'time' => 'Time',
            'ip' => 'IP',
        ];
    }
}
