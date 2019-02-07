<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property string $unifi_url
 * @property string $unifi_login
 * @property string $unifi_pass
 * @property int $session_time
 * @property int $speed_up
 * @property int $speed_down
 * @property int $id
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['session_time', 'speed_up', 'speed_down'], 'integer'],
            [['unifi_url', 'unifi_login', 'unifi_pass'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'unifi_url' => 'Unifi Url',
            'unifi_login' => 'Unifi Login',
            'unifi_pass' => 'Unifi Pass',
            'session_time' => 'Session Time',
            'speed_up' => 'Speed Up',
            'speed_down' => 'Speed Down',
            'id' => 'ID',
        ];
    }
}
