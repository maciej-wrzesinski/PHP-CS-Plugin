<?php

include('Smarty\Smarty.class.php');

class TemplateFacade {
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
    }

    public function getSmarty()
    {
        return $this->smarty;
    }

    public function displayHTML($filename)
    {
        if($filename !== 'index')
            $this->smarty->assign("yesthisisindex", "1");
        else
            $this->smarty->assign("yesthisisindex", "0");

        $this->smarty->display('_HEADER.tpl');
        $this->smarty->display($filename.'.tpl');
        $this->smarty->display('_FOOTER.tpl');
    }
}