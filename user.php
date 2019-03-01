<?php require 'includes/steamauth/steamauth.php'; ?>
<?php
	include("config/global.php");
	include("config/db.php");
	include("includes/functions.php");
	include("includes/lang.php");
	
	////Smarty 
	require_once("smarty/libs/Smarty.class.php");
	$smarty=new Smarty();
	
	$USERID = 0;
	$STEAMID = toSteamID($_SESSION['steamid']);
	if(!isset($_SESSION['steamid'])){
		Redirect($WWW_URL);
		die("You don't have acces here");
	}  else {
		$smarty->assign("logoutbutton", "<a href='?logout' class='btn-flat'>".$lang['LOGOUT']."</a>");
		$smarty->assign("logoutbuttonn", "<a href='?logout'>".$lang['LOGOUT']."</a>");
		include ('includes/steamauth/userInfo.php');
		
		$query = "SELECT id FROM `".$TABLE_USERS."` WHERE `sid` = '".$STEAMID."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		$USERID = 0;
		while($row = mysqli_fetch_row($result))
			$USERID = $row[0];
		
		if($USERID == 0){
			Redirect($WWW_URL);
			die("You don't have acces here");
		}
		
		//liczba ticketów
		$query = "SELECT id_ticket FROM `".$TABLE_HELPDESK."` WHERE seen = 0 AND reciver = ".$USERID.";";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		$UNSEEN = mysqli_num_rows($result);
		$smarty->assign("UNSEEN", $UNSEEN);
		
		$query = "SELECT id FROM `".$TABLE_USERS."` WHERE `sid` = '".$STEAMID."' AND `level` = '1';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		$USERID2 = 0;
		while($row = mysqli_fetch_row($result))
			$USERID2 = $row[0];
		
		if($USERID2 != 0){
			$smarty->assign("isadmin", "1");
		}
	}
	
	//Lista pluginów jego
	$query = "SELECT * FROM `".$TABLE_LICENSES."` INNER JOIN `".$TABLE_PLUGINS."` ON `".$TABLE_PLUGINS."`.`id` = `".$TABLE_LICENSES."`.`plugin_id` WHERE `user_id` = '".$USERID."';";
	$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	while($row = mysqli_fetch_row($result)){
		$plugin = array(
			"plugin_name"	=> $row[5],
			"plugin_id"	=> $row[3],
			"plugin_dl"	=> $row[9]
		);
		$plugin_list[] = $plugin;
	}
	if(count($plugin_list) > 0)
		$smarty->assign("plugin_list", $plugin_list);
	else{
		$smarty->assign("errorex", "1");
	}
	
	//wysłanie ticketu
	if(isset($_POST['textofticket'])){
		$query = "SELECT DISTINCT id_ticket FROM `".$TABLE_HELPDESK."` WHERE 1;";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		$TicketID = mysqli_num_rows($result)+1;
		$TicketText = mysql_escape_mimic($_POST['textofticket']);
		
		$query = "INSERT INTO `".$TABLE_HELPDESK."` (id_ticket, sender, reciver, text, timestamp_write) VALUES ('".$TicketID."', '".$USERID."', '0', '".$TicketText."', '".time()."');";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		$smarty->assign("sendticket", "1");
		
		Redirect($WWW_URL."ticket.php?id=".$TicketID);
	}
	
	//Lista napisanych przez niego ticketów
	$query = "SELECT tbl.id, tbl.id_ticket, tbl.sender, tbl.reciver, tbl.text, tbl.timestamp_write, tbl.seen 
		FROM `".$TABLE_HELPDESK."` AS tbl
		INNER JOIN 
		(SELECT id_ticket,max(timestamp_write) as lastest FROM `".$TABLE_HELPDESK."` WHERE `sender` = '".$USERID."' OR `reciver` = '".$USERID."' GROUP BY id_ticket) AS tbl2
		ON
		tbl.timestamp_write = tbl2.lastest AND tbl.id_ticket = tbl2.id_ticket
		ORDER BY tbl.timestamp_write DESC;";
	$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	while($row = mysqli_fetch_row($result)){
		$ticket = array(
			"ticketid"	=> $row[1],
			"text"	=> substr($row[4], 0, 30)."...",
			"time"	=> gmdate("Y-m-d H:i", $row[5]),
			"seen"	=> $row[6]
		);
		$ticket_list[] = $ticket;
	}
	if(count($ticket_list) > 0)
		$smarty->assign("ticket_list", $ticket_list);
	else
		$smarty->assign("notickets", "1");
	
	$smarty->assign("TITLE", $lang['TITLE']);
	$smarty->assign("TITLE2", $lang['USERP']);
	
	$smarty->assign("HOME", $lang['HOME']);
	$smarty->assign("PLUGINS", $lang['PLUGINS']);
	$smarty->assign("BUY", $lang['BUY']);
	$smarty->assign("USERP", $lang['USERP']);
	$smarty->assign("ADMIN", $lang['ADMIN']);
	$smarty->assign("GENERATORVIP", $lang['GENERATORVIP']);
	$smarty->assign("OPINIONS", $lang['OPINIONS']);
	
	$smarty->assign("PANEL", $lang['PANEL']);
	$smarty->assign("YOURLICENSES", $lang['YOURLICENSES']);
	$smarty->assign("CLICKIP", $lang['CLICKIP']);
	$smarty->assign("NOLICENSES", $lang['NOLICENSES']);
	$smarty->assign("BUYSOME", $lang['BUYSOME']);
	$smarty->assign("DOWNLOAD", $lang['DOWNLOAD']);
	$smarty->assign("HELPDESK", $lang['HELPDESK']);
	$smarty->assign("TICKETSEND", $lang['TICKETSEND']);
	$smarty->assign("HOWCANWEHELP", $lang['HOWCANWEHELP']);
	$smarty->assign("NOTICKETS", $lang['NOTICKETS']);
	$smarty->assign("ID", $lang['ID']);
	$smarty->assign("TEXT", $lang['TEXT']);
	$smarty->assign("WRITTEN", $lang['WRITTEN']);
	$smarty->assign("STATUS", $lang['STATUS']);
	$smarty->assign("SEEN", $lang['SEEN']);
	$smarty->assign("PENDING", $lang['PENDING']);
	$smarty->assign("WRITEATICKET", $lang['WRITEATICKET']);
	$smarty->assign("TELLUSWHATSWRONG", $lang['TELLUSWHATSWRONG']);
	$smarty->assign("SEND", $lang['SEND']);
	$smarty->assign("NEW", $lang['NEW']);
	
	//Funny quotes
	$smarty->assign("QUOTES", $lang['QUOTE'][array_rand($lang['QUOTE'])]);
	$smarty->assign("DESCRIPTION", $lang['DESCRIPTION']);
	$smarty->assign("KEYWORDS", $lang['KEYWORDS']);
	
	////Display HTML
	$smarty->display('_HEADER.tpl');
	$smarty->display('user.tpl');
	$smarty->display('_FOOTER.tpl');
?>