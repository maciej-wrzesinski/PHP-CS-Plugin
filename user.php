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
        header('Location: '.substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], "/")), true, 302);
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


        /*
         * Something handling
         */
        $queryPDO = $connection->prepare('SELECT id_ticket FROM csp_helpdesk WHERE seen = 0 AND reciver = ?');
        $queryPDO->execute([$_SESSION['steamid']]);

        $template->assignVariable("UNSEEN", $queryPDO->rowCount());


        /*
         * Something handling
         */
        $queryPDO = $connection->prepare('SELECT * FROM csp_licenses INNER JOIN csp_plugin ON csp_plugin.id = csp_licenses.plugin_id WHERE user_id = ?');
        $queryPDO->execute([$_SESSION['steamid']]);
        $plugin_list = [];
        while ($row = $queryPDO->fetch())
        {
            $plugin = array(
                "plugin_name"	=> $row[5],
                "plugin_id"	=> $row[3],
                "plugin_dl"	=> $row[9]
            );
            $plugin_list[] = $plugin;
        }
        $template->assignVariable("plugin_list", $plugin_list);

        //Lista napisanych przez niego ticketów
        $queryPDO = $connection->prepare('SELECT tbl.id, tbl.id_ticket, tbl.sender, tbl.reciver, tbl.text, tbl.timestamp_write, tbl.seen 
		FROM csp_helpdesk AS tbl
		INNER JOIN 
		(SELECT id_ticket,max(timestamp_write) as lastest FROM csp_helpdesk WHERE `sender` = ? OR `reciver` = ? GROUP BY id_ticket) AS tbl2
		ON tbl.timestamp_write = tbl2.lastest AND tbl.id_ticket = tbl2.id_ticket
		ORDER BY tbl.timestamp_write DESC');
        $queryPDO->execute([$_SESSION['steamid'], $_SESSION['steamid']]);
        while ($row = $queryPDO->fetch())
        {
            $ticket = array(
                "ticketid"	=> $row[1],
                "text"	=> substr($row[4], 0, 30)."...",
                "time"	=> gmdate("Y-m-d H:i", $row[5]),
                "seen"	=> $row[6]
            );
            $ticket_list[] = $ticket;
        }
        $template->assignVariable("ticket_list", $ticket_list);


        //wysłanie ticketu
        if(isset($_POST['textofticket'])){
            $queryPDO = $connection->prepare('SELECT DISTINCT id_ticket FROM `".$TABLE_HELPDESK."` WHERE 1');
            $queryPDO->execute();

            $TicketID = mysqli_num_rows($result)+1;
            $TicketText = mysql_escape_mimic($_POST['textofticket']);

            $queryPDO = $connection->prepare('INSERT INTO `".$TABLE_HELPDESK."` (id_ticket, sender, reciver, text, timestamp_write) VALUES (?, ?, 0, ?, ?)');
            $queryPDO->execute([$TicketID, $_SESSION['steamid'], $TicketText, time()]);

            $template->assignVariable("sendticket", "1");

            header('Location: '.substr($_SERVER['PHP_SELF'], 0, strrpos($_SERVER['PHP_SELF'], "/"))."/ticket.php?id=".$TicketID, true, 302);
        }

    }


    /*
     * This is something that will change for sure with every subpage
     */
    $template->assignVariable("TITLE2", $lang['USERP']);


    /*
     * Show HTML
     */
    $fileName = basename(__FILE__, '.php');
    $template->displayHTML($fileName);
