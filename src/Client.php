<?php

/**
 * Created by PhpStorm.
 * User: pablomartincarpio
 * Date: 4/5/18
 * Time: 12:01
 */
namespace Webimpacto\App4Less;

class Client
{
    const RESKYT_URL_API = 'https://app.reskyt.com/api/';
    /**
     * @var string
     */
    private $user_api;
    /**
     * @var string
     */
    private $password_api;


    public function __construct($user_apì, $password_api)
    {
        $this->user_api = $user_apì;
        $this->password_api = $password_api;
    }

    public function sendPushNotification($tokens = null, $titulo = null, $url = null, $utm_campaign = null)
    {
        $data = array("user" => $this->user_api, "password" => $this->password_api,
            "titulo" => $titulo, "url" => $url,
            "campaign" => $utm_campaign, "tokens" => $tokens);

        return $this->sendApi('push', $data);
    }

    private function sendApi($action, $data)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, self::RESKYT_URL_API . $action);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($curl);
        if ($response == "1") {
            return true;
        } else {
            return false;
        }
    }

    public static function isApp4Less()
    {
        $isApp4Less = false;
        $headers = getallheaders();


        if (isset($headers['X-Requested-With']) &&
            (strpos($headers['X-Requested-With'], 'reskyt') == true
                || strpos($headers['X-Requested-With'], 'app4less') == true)
        ) {

            setcookie('isApp4Less', true, time() + (86400), "/");
            $isApp4Less = true;

        } else if (isset($headers['Referer']) &&
            (strpos($headers['Referer'], 'app.reskyt') == true
                || strpos($headers['Referer'], 'app.app4less') == true
            )
        ) {

            setcookie('isApp4Less', true, time() + (86400), "/");
            $isApp4Less = true;
        } else if (isset($_COOKIE['isApp4Less']) && $_COOKIE['isApp4Less'] == true) {
            $isApp4Less = true;
        }

        return $isApp4Less;
    }

    public static function getAPPToken()
    {
        if (self::isApp4Less()) {
            if (isset($_GET['token_app'])) {
                setcookie('token_app', $_GET['token_app'], time() + (86400), "/");
                return $_GET['token_app'];
            }

            if (isset($_COOKIE['token_app'])) {
                return $_COOKIE['token_app'];
            }
        }

        return false;
    }


    public static function getAppUUID()
    {
        if (self::isApp4Less()) {
            if (isset($_GET['uuid'])) {
                setcookie('uuid_app', $_GET['token_app'], time() + (86400), "/");
                return $_GET['uuid'];
            }

            if (isset($_COOKIE['uuid_app'])) {
                return $_COOKIE['uuid_app'];
            }
        }

        return false;
    }


}