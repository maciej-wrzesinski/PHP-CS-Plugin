<?php

include('Smarty\Smarty.class.php');

class TemplateFacade
{
    private $smarty;

    public function __construct()
    {
        $this->smarty = new Smarty();
        $this->smarty->error_reporting = 0;
    }

    public function assignVariable($name, $value)
    {
        return $this->smarty->assign($name, $value);
    }

    public function displayTemplate($name)
    {
        return $this->smarty->display($name);
    }

    public function displayHTML($filename)
    {
        $this->displayTemplate('_HEADER.tpl');
        $this->displayTemplate($filename.'.tpl');
        $this->displayTemplate('_FOOTER.tpl');
    }
}