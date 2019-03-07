<?php

include('LightOpenID\openid.php');

class LoginFacade {
    private $openid;

    public function __construct()
    {
        ob_start();
        session_start();
        $this->openid = new LightOpenID($_SERVER['PHP_SELF']);
    }

    public function login()
    {
        try
        {
            if(!$this->openid->__get('mode'))
            {
                $this->openid->__set('identity', 'https://steamcommunity.com/openid');
                echo '<meta http-equiv="REFRESH" content="0;url='. $this->openid->authUrl() .'">';
            }
            elseif($this->openid->__get('mode') === 'cancel')
            {
                echo 'Authentication canceled';
                return 'fail';
            }
            else
                {
                if($this->openid->validate())
                {
                    preg_match('/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/', $this->openid->__get('identity'), $matches);

                    echo '<meta http-equiv="REFRESH" content="0;url='. $_SERVER['PHP_SELF'] .'">';
                    return $matches[1]; //return steamid
                }
                else
                    {
                    echo 'Logging in failed';
                    return 'fail';
                }
            }
        }
        catch(ErrorException $e)
        {
            echo $e->getMessage();
            return 'fail';
        }

        return 'fail';
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        echo '<meta http-equiv="REFRESH" content="0;url='. $_SERVER['PHP_SELF'] .'">';
    }

    public function update()
    {
        unset($_SESSION['steam_uptodate']);
        echo '<meta http-equiv="REFRESH" content="0;url='. $_SERVER['PHP_SELF'] .'">';
    }
}