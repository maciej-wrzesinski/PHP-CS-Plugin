<?php
    /*
     * Login handling
     */
    require('classes/login/LoginFacade.php');
    $login = new LoginFacade();

    if(isset($_GET['login']))
    {
        $_SESSION['steamid'] = $login->login();
    }
    elseif(isset($_GET['logout']))
    {
        $login->logout();
    }


    /*
     * Template handling
     */
    require('classes/template/TemplateFacade.php');
    $template = new TemplateFacade();


    /*
     * Language handling
     */
    require('classes/language/Language.php');
    $lang = new Language();

    $fileLang = $lang->getCurrentLanguage();
    include_once(dirname(__FILE__).'/languages/'.$fileLang.'.php');


    /*
     * Something handling
     */
    if(!isset($_SESSION['steamid']) || $_SESSION['steamid'] === 'fail')
    {
        $template->assignVariable("login_button_main", "1");
        $template->assignVariable("login_button_mobile", "1");
        $template->assignVariable("login_button_header", "1");
    }
    else
    {
        $template->assignVariable("logout_button_header", "1");
        $template->assignVariable("logout_button_mobile", "1");
    }

    require('classes/database/DatabaseSingleton.php');
    $db = DatabaseSingleton::getInstance();
    $connection = $db->getConnection();

    $USERID = 0;
    $USERLEVEL = 0;
    $query = "SELECT id, level FROM `csp_users` WHERE `sid` = '".$_SESSION['steamid']."';";
    $result = mysqli_query($connection, $query) or die("Connection error".mysqli_error($connection));
    while($row = mysqli_fetch_row($result))
    {
        $USERID = $row[0];
        $template->assignVariable("isadmin", $row[1]);
    }

    if($USERID == 0){//dodawanie usera
        $query = "INSERT INTO `csp_users` (sid, level, opinion) VALUES ('".$_SESSION['steamid']."', '0', '');";
        $result = mysqli_query($connection, $query) or die("Connection error".mysqli_error($connection));
    }


    /*
     * This is something that will change for sure with every subpage
     */
    $template->assignVariable("TITLE2", $lang['HOME']);


    /*
     * Show HTML
     */
    $fileName = basename(__FILE__, '.php');
    $template->displayHTML($fileName);