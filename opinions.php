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


    $queryPDO = $connection->prepare('SELECT * FROM csp_users WHERE opinion <> \'\' order by id desc');
    $queryPDO->execute();
    while ($row = $queryPDO->fetch())
    {
        $opinion = array(
            "id"		    => $row[0],
            "steamnumber"	=> $row[1],
            "opinion"   	=> $row[3]
        );
        $opinion_list[] = $opinion;
    }
    $template->assignVariable("opinion_list", $opinion_list);


    /*
     * Show HTML
     */
    $fileName = basename(__FILE__, '.php');
    $template->displayHTML($fileName);






if(isset($_POST['opinion']) && $_POST['opinion'] != "" && $USERID > 0){
    $opinion = mysql_escape_mimic(stripslashes($_POST['opinion']));
    if((strpos($opinion, 'drop') !== false) || (strpos($opinion, 'table') !== false))
        $opinion = "XD1";

    if(!preg_match("/^[^\\\'\`\%\-\"\;]+$/", $opinion) || strlen($opinion) < 1)
        $opinion = "XD2";

    if(strlen($opinion) > 200)
        $opinion = "XD3";

    $query = "UPDATE `".$TABLE_USERS."` SET opinion = '".$opinion."' WHERE id = ".$USERID.";";
    $result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
}
