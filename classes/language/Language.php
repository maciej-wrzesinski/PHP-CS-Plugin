<?php

class Language
{
    private $currentLang = '';

    public function __construct()
    {
        $this->setCurrentLanguage('en');

        if(isset($_GET['lang']) && $this->IsLanguageAvailable($_GET['lang']))
        {
            setcookie("lang", $_GET['lang'], time() + 3600 * 24 * 30);
            $this->setCurrentLanguage($_GET['lang']);
        }
        elseif(isset($_COOKIE['lang']) && $this->IsLanguageAvailable($_COOKIE['lang']))
        {
            $this->setCurrentLanguage($_COOKIE['lang']);
        }
        elseif(empty($this->currentLang))
        {
            $browserLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

            if($this->IsLanguageAvailable($browserLang))
            {
                $this->setCurrentLanguage($browserLang);
            }
        }
    }

    public function getCurrentLanguage()
    {
        return $this->currentLang;
    }

    public function setCurrentLanguage($lang)
    {
        $this->currentLang = $lang;
    }

    private function IsLanguageAvailable($lang)
    {
        return $this->DoesLanguageFileExist($lang);
    }

    private function DoesLanguageFileExist($lang)
    {
        return file_exists('languages/'.strtolower($lang).'.php');
    }
}