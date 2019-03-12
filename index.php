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
        $template->assignVariable("login_button_main", "<a href='?login'><img src='./assets/images/steamloginv2.png'></a>");
        $template->assignVariable("login_button_mobile", "<a href='?login'>".$lang['LOGIN']."</a>");
        $template->assignVariable("login_button_header", "<a href='?login' class='btn-flat'>".$lang['LOGIN']."</a>");
    }
    else
    {
        $template->assignVariable("logout_button_header", "<a href='?logout' class='btn-flat'>".$lang['LOGOUT']."</a>");
        $template->assignVariable("logout_button_mobile", "<a href='?logout'>".$lang['LOGOUT']."</a>");

    }

    require('classes/database/DatabaseSingleton.php');
    $db = DatabaseSingleton::getInstance();
    $connection = $db->getConnection();

    $USERID = 0;
    $query = "SELECT id FROM `".$TABLE_USERS."` WHERE `sid` = '".$_SESSION['steamid']."';";
    $result = mysqli_query($connection, $query) or die("Connection error".mysqli_error($connection));
    while($row = mysqli_fetch_row($result))
        $USERID = $row[0];

    if($USERID == 0){//dodawanie usera
        $query = "INSERT INTO `".$TABLE_USERS."` (sid, level, opinion) VALUES ('".$_SESSION['steamid']."', '0', '');";
        $result = mysqli_query($connection, $query) or die("Connection error".mysqli_error($connection));
    }
    else{
        $query = "SELECT id FROM `".$TABLE_USERS."` WHERE `sid` = '".$_SESSION['steamid']."' AND `level` = '1';";
        $result = mysqli_query($connection, $query) or die("Connection error".mysqli_error($connection));

        $USERID2 = 0;
        while($row = mysqli_fetch_row($result))
            $USERID2 = $row[0];

        if($USERID2 != 0){
            $template->assignVariable("isadmin", "1");
        }
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