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
    if(!isset($_SESSION['steamid']) || $_SESSION['steamid'] === '0')
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
    $template->assignVariable("TITLE2", $lang['PLUGINS']);


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


    $queryPDO = $connection->prepare('SELECT * FROM csp_plugin INNER JOIN csp_authors ON csp_plugin.author = csp_authors.id order by price desc');
    $queryPDO->execute();
    while ($row = $queryPDO->fetch())
    {
        /*$query2 = "SELECT * FROM `".$TABLE_LICENSES."` WHERE plugin_id = '".$row[0]."' AND user_id = '".$USERID."';";
        $result2 = mysqli_query($sql, $query2) or die("Connection error".mysqli_error($sql));
        $hasthisplugin = 0;
        while($row2 = mysqli_fetch_row($result2)){
            $hasthisplugin = 1;
        }*/

        $plugin = array(
            "id"		=> $row[0],
            "author"	=> $row[1],
            "name"		=> $row[2],
            "short_name"=> $row[3],
            "price"		=> $row[4],
            "price_euro" => round(((int)$row[4])/4.0, 0),
            "price_dolar" => round(((int)$row[4])/3.5, 0),
            "time"		=> $row[5],
            "link"		=> $row[6],
            "desc"		=> $row[7],
            "author_name"	=> $row[10],
            "author_sid"	=> $row[11],
            "hasthisplugin"	=> 1
        );
        $plugin_list[] = $plugin;
    }
    $template->assignVariable("plugin_list", $plugin_list);


    /*
     * Show HTML
     */
    $fileName = basename(__FILE__, '.php');
    $template->displayHTML($fileName);
