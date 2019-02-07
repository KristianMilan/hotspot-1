<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "voucher".
 *
 * @property int $id
 * @property string $password
 * @property int $time
 */
class Voucher extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'voucher';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password', 'time'], 'required'],
            [['time'], 'integer'],
            [['password'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password' => 'Пароль',
            'time' => 'Время жизни (до)',
        ];
    }
}
