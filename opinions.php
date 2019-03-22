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

    include_once(dirname(__FILE__).'/languages/'.$lang->getCurrentLanguage().'.php');


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


        /*
         * PDO handling
         */
        require_once('classes/database/DatabaseSingleton.php');
        $db = DatabaseSingleton::getInstance();
        $connection = $db->getConnection();


        $queryPDO = $connection->prepare('SELECT level FROM csp_users WHERE sid = ?');
        $queryPDO->execute([$_SESSION['steamid']]);
        while ($row = $queryPDO->fetch())
        {
            $template->assignVariable("isadmin", $row[0]);
        }
    }


    /*
     * This is something that will change for sure with every subpage
     */
    $template->assignVariable("TITLE2", $lang['OPINIONS']);


    /*
     * This PDO action that will vary on every subpage
     */
    require_once('classes/database/DatabaseSingleton.php');
    $db = DatabaseSingleton::getInstance();
    $connection = $db->getConnection();


    $queryPDO = $connection->prepare('SELECT * FROM csp_authors');
    $queryPDO->execute();
    while ($row = $queryPDO->fetch())
    {
        $author = array(
            "name"	=> $row[1],
            "link"	=> $row[2]
        );
        $author_list[] = $author;
    }
    $template->assignVariable("author_list", $author_list);


    $queryPDO = $connection->prepare('SELECT opinion FROM csp_users WHERE sid = ?');
    $queryPDO->execute([$_SESSION['steamid']]);
    while ($row = $queryPDO->fetch())
    {
        if($row[0] != '')
            $template->assignVariable("alreadyopinion", "1");
    }


    $queryPDO = $connection->prepare('SELECT sid, opinion FROM csp_users WHERE opinion <> \'\'');
    $queryPDO->execute();
    while ($row = $queryPDO->fetch())
    {
        $opinion = array(
            "steamnumber"   => $row[0],
            "opinion"       => $row[1]
        );
        $opinion_list[] = $opinion;
    }
    $template->assignVariable("opinion_list", $opinion_list);


    /*
     * This is POST/GET action
     */
    if(isset($_POST['opinion']) && $_POST['opinion'] != "" && strlen($_SESSION['steamid']) > 10){
        $opinion = stripslashes($_POST['opinion']);

        $queryPDO = $connection->prepare('UPDATE csp_users SET opinion = ? WHERE sid = ?');
        $queryPDO->execute([$opinion, $_SESSION['steamid']]);
    }


    /*
     * Show HTML
     */
    $fileName = basename(__FILE__, '.php');
    $template->displayHTML($fileName);







