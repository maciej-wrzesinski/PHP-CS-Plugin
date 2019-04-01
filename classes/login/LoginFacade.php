<?php

include('LightOpenID\openid.php');

class LoginFacade
{
    private $openid;

    public function __construct()
    {
        ob_start();
        session_start();
        $this->openid = new LightOpenID($_SERVER['PHP_SELF']);
    }

    public function login()
    {
        return 'STEAM_0:0:37629143';
        if(!$this->openid->__get('mode'))
        {
            $this->openid->__set('identity', 'https://steamcommunity.com/openid');
            header('Location: '.$this->openid->authUrl(), true, 302);
        }
        elseif($this->openid->__get('mode') === 'cancel')
        {
            echo 'Authentication canceled';
        }
        else
        {
            if($this->openid->validate())
            {
                preg_match('/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/', $this->openid->__get('identity'), $matches);

                //header('Location: '.$_SERVER['PHP_SELF'], true, 302);
                return $matches[1]; //return steamid
            }
            else
            {
                echo 'Logging in failed';
            }
        }

        return '0';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: '.$_SERVER['PHP_SELF'], true, 302);
    }

    public function update()
    {
        unset($_SESSION['steam_uptodate']);
        header('Location: '.$_SERVER['PHP_SELF'], true, 302);
    }
}