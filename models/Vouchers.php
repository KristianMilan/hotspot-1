<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vouchers".
 *
 * @property int $id
 * @property string $login
 * @property int $code
 * @property string $name
 * @property string $last_name
 * @property string $phone
 */
class Vouchers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vouchers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['login', 'code', 'name', 'last_name', 'phone'], 'required'],
            [['code'], 'integer'],
            [['login', 'name', 'last_name'], 'string', 'max' => 50],
            [['phone'], 'string', 'max' => 12],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'code' => 'Код',
            'name' => 'Имя',
            'last_name' => 'Фамилия',
            'phone' => 'Телефон',
        ];
    }
}
