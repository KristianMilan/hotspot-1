<?php
/**
 * Created by PhpStorm.
 * User: FOJIK
 * Date: 25.07.2018
 * Time: 15:40
 */
// /guest/s/default/?id=aa:bb:cc:dd:ee:ff&ap=00:11:22:33:44:55&t=1234567890&url=http://connectivitycheck.gstatic.com/generate_204&ssid=our-wifi-hotspot-ssid

namespace app\controllers;

use app\models\Aps;
use app\models\Config;
use app\models\Places;
use app\models\Smsc;
use app\models\Voucher;
use app\models\Vouchers;
use UniFi_API\Client;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;

class GuestController extends Controller
{

    public function actionIndex()
    {
        if(empty($_REQUEST['id']) && empty($_REQUEST['ap']) && empty($_REQUEST['url']) && empty($_REQUEST['ssid']) && empty($_REQUEST['t'])) die('Ошибка, не найдены mac, ap, url');

        $errors = null;

        $params['mac'] = $_REQUEST['id'];
        $params['ap'] = $_REQUEST['ap'];
        $params['url'] = $_REQUEST['url'];
        $params['ssid'] = $_REQUEST['ssid'];
        $params['time'] = $_REQUEST['t'];

        $places = Aps::findOne(['mac' => $params['ap']]);

        if(empty($places)) die('Мак адрес AP не найден в базе данных');

        if(Yii::$app->request->isPost)
        {
            $phone = !empty($_REQUEST['phone']) ? $_REQUEST['phone'] : '';
            $pass = !empty($_REQUEST['pass']) ? $_REQUEST['pass'] : '';

            settype($phone, 'integer');

            if($phone == '')
                $errors = 'Не верный номер телефона';
            if(strlen($phone) != 12)
                $errors = 'Не верный номер телефона';
$ttt = time();
            $voucher = Yii::$app->db->createCommand('SELECT * FROM `voucher` WHERE `password` = :pass AND `time` >= :t')
                ->bindParam(':pass',$pass)
                ->bindParam(':t', $ttt)->queryOne();


            if(empty($voucher))
                $errors = 'Не верный пароль от сети WiFi';

            if($errors == null)
            {
                $smsc = Smsc::find()->where(['mac' => $params['mac'], 'phone' => $phone, 'status' => 0])->orderBy(['id' => SORT_DESC])->one();

                if(!empty($smsc) && !empty($_REQUEST['change_nmb']))
                {
                    $smsc->status = 2;
                    $smsc->save();
                    $this->redirect('/?'.$_SERVER['QUERY_STRING']);
                }

                if(!empty($smsc) && strtotime($smsc->time)+600 > time())
                {
                    if(!empty($_REQUEST['code']))
                    {
                        if(strlen($_REQUEST['code']) <= 6)
                        {
                            if($smsc->code == $_REQUEST['code'])
                            {
                                $smsc->status = 1;
                                $smsc->save();

                                $config = Config::findOne(['id' => 1]);

                                $unifi = new Client($config->unifi_login, $config->unifi_pass, $config->unifi_url, 'default', '5.8.24', false);
                                $unifi->login();
                                $unifi->authorize_guest($params['mac'], $config->session_time, $config->speed_up, $config->speed_down);
                                return $this->render('auth', ['url' => $params['url']]);
                            }
                            else
                                $errors = 'Не верный код';
                        }
                        else
                            $errors = 'Не верный код';
                    }
                    return $this->render('confirm', ['errors' => $errors, 'params' => $params, 'phone' => $phone, 'pass' => $pass]);
                }

                $ip = '';
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }

                $code = rand(000,999).rand(000, 999);
                $smsc = new Smsc();

                $smsc->mac = $params['mac'];
                $smsc->ap_mac = $params['ap'];
                $smsc->code = $code;
                $smsc->ip = $ip;
                $smsc->phone = $phone;

                file_get_contents('http://localhost/guest/s/tetsend?text=Code:'.$code.'&phone='.$phone);

                if($smsc->validate() && $smsc->save())
                {
                    return $this->render('confirm', ['errors' => $errors,'params' => $params, 'phone' => $phone, 'pass' => $pass]);
                }

            }
        }

        $smsc = Smsc::find()->where(['mac' => $params['mac']])->orderBy(['id' => SORT_DESC])->one();

        return $this->render('index', ['errors' => $errors,'params' => $params, 'smsc' => $smsc]);
    }

    /**
     * С ваучером
     */
    /*
    public function actionIndex()
    {
        $errors = null;

        $params['mac'] = $_REQUEST['id'];
        $params['ap'] = $_REQUEST['ap'];
        $params['url'] = $_REQUEST['url'];
        $params['ssid'] = $_REQUEST['ssid'];
        $params['time'] = $_REQUEST['t'];

        return $this->render('home', ['errors' => $errors,'params' => $params]);
    }

    public function actionGuest()
    {
        if(empty($_REQUEST['id']) && empty($_REQUEST['ap']) && empty($_REQUEST['url']) && empty($_REQUEST['ssid']) && empty($_REQUEST['t'])) die('Ошибка, не найдены mac, ap, url');

        $errors = null;

        $params['mac'] = $_REQUEST['id'];
        $params['ap'] = $_REQUEST['ap'];
        $params['url'] = $_REQUEST['url'];
        $params['ssid'] = $_REQUEST['ssid'];
        $params['time'] = $_REQUEST['t'];

        $places = Aps::findOne(['mac' => $params['ap']]);

        if(empty($places)) die('Мак адрес AP не найден в базе данных');

        if(Yii::$app->request->isPost)
        {
            $phone = !empty($_REQUEST['phone']) ? $_REQUEST['phone'] : '';

            settype($phone, 'integer');

            if($phone == '')
                $errors = 'Не верный номер телефона';
            if(strlen($phone) != 12)
                $errors = 'Не верный номер телефона';

            if($errors == null)
            {
                $smsc = Smsc::find()->where(['mac' => $params['mac'], 'phone' => $phone, 'status' => 0])->orderBy(['id' => SORT_DESC])->one();

                if(!empty($smsc) && !empty($_REQUEST['change_nmb']))
                {
                    $smsc->status = 2;
                    $smsc->save();
                    $this->redirect('/?'.$_SERVER['QUERY_STRING']);
                }

                if(!empty($smsc) && strtotime($smsc->time)+600 > time())
                {
                    if(!empty($_REQUEST['code']))
                    {
                        if(strlen($_REQUEST['code']) <= 6)
                        {
                            if($smsc->code == $_REQUEST['code'])
                            {
                                $smsc->status = 1;
                                $smsc->save();

                                $config = Config::findOne(['id' => 1]);

                                $unifi = new Client($config->unifi_login, $config->unifi_pass, $config->unifi_url, 'default', '5.8.24', false);
                                $unifi->login();
                                $unifi->authorize_guest($params['mac'], $config->session_time, $config->speed_up, $config->speed_down);
                                return $this->render('auth', ['url' => $params['url']]);
                            }
                            else
                                $errors = 'Не верный код';
                        }
                        else
                            $errors = 'Не верный код';
                    }
                    return $this->render('confirm', ['errors' => $errors, 'params' => $params, 'phone' => $phone]);
                }

                $ip = '';
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }

                $code = rand(000,999).rand(000, 999);
                $smsc = new Smsc();

                $smsc->mac = $params['mac'];
                $smsc->ap_mac = $params['ap'];
                $smsc->code = $code;
                $smsc->ip = $ip;
                $smsc->phone = $phone;

                file_get_contents('http://дщсфдрщые/guest/s/tetsend?text=Code:'.$code.'&phone='.$phone);

                if($smsc->validate() && $smsc->save())
                {
                    return $this->render('confirm', ['errors' => $errors,'params' => $params, 'phone' => $phone]);
                }

            }
        }

        $smsc = Smsc::find()->where(['mac' => $params['mac']])->orderBy(['id' => SORT_DESC])->one();

        return $this->render('index', ['errors' => $errors,'params' => $params, 'smsc' => $smsc]);
    }

    public function actionVoucher()
    {
        if(empty($_REQUEST['id']) && empty($_REQUEST['ap']) && empty($_REQUEST['url']) && empty($_REQUEST['ssid']) && empty($_REQUEST['t'])) die('Ошибка, не найдены mac, ap, url');

        $errors = null;

        $params['mac'] = $_REQUEST['id'];
        $params['ap'] = $_REQUEST['ap'];
        $params['url'] = $_REQUEST['url'];
        $params['ssid'] = $_REQUEST['ssid'];
        $params['time'] = $_REQUEST['t'];

        $places = Aps::findOne(['mac' => $params['ap']]);

        if(empty($places)) die('Мак адрес AP не найден в базе данных');

        if(Yii::$app->request->isPost) {
            $code = !empty($_REQUEST['code']) ? $_REQUEST['code'] : '';
            $login = !empty($_REQUEST['code']) ? $_REQUEST['login'] : '';

            settype($code, 'integer');

            if ($code == '' && $login == '')
                $errors = 'Не верный логин или код';

            $voucher = Vouchers::find()->where(['login' => $login, 'code' => $code])->one();

            if (empty($voucher) || $voucher == '')
                $errors = 'Не верный логин или код';


            if ($errors == null) {

                $ip = '';
                if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                } else {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }

                //$code = 0;
                $smsc = new Smsc();

                $smsc->mac = $params['mac'];
                $smsc->ap_mac = $params['ap'];
                $smsc->code = $code;
                $smsc->ip = $ip;
                $smsc->phone = $voucher->phone;

                $smsc->save(false);

                $config = Config::findOne(['id' => 1]);

                $unifi = new Client($config->unifi_login, $config->unifi_pass, $config->unifi_url, 'default', '5.8.24', false);
                $unifi->login();
                $unifi->authorize_guest($params['mac'], $config->session_time, $config->speed_up, $config->speed_down);
                return $this->render('auth', ['url' => $params['url']]);

            }
        }
        return $this->render('voucher', ['errors' => $errors, 'params' => $params]);
    }
    */
}