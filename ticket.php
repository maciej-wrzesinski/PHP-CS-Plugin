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
		
		while($row = mysqli_fetch_row($result))
			$USERID = $row[0];
		
		$query = "SELECT id FROM `".$TABLE_USERS."` WHERE `sid` = '".$STEAMID."' AND `level` = '1';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		$USERID2 = 0;
		while($row = mysqli_fetch_row($result))
			$USERID2 = $row[0];
		
		if($USERID2 != 0){
			$smarty->assign("isadmin", "1");
		}
	}
	
	
	if(isset($_GET['id']) && $_GET['id'] != "" && $_GET['id'] > 0){
		$ticket_id = mysql_escape_mimic($_GET['id']);
		
		if($USERID2 == 0)
			$query = "SELECT * FROM `".$TABLE_HELPDESK."` INNER JOIN `".$TABLE_USERS."` ON `".$TABLE_USERS."`.id = `".$TABLE_HELPDESK."`.sender OR `".$TABLE_USERS."`.id = `".$TABLE_HELPDESK."`.reciver WHERE id_ticket = '".$ticket_id."' AND (sender = '".$USERID."' OR reciver = '".$USERID."') ORDER BY timestamp_write;";
		else
			$query = "SELECT * FROM `".$TABLE_HELPDESK."` INNER JOIN `".$TABLE_USERS."` ON `".$TABLE_USERS."`.id = `".$TABLE_HELPDESK."`.sender OR `".$TABLE_USERS."`.id = `".$TABLE_HELPDESK."`.reciver WHERE id_ticket = '".$ticket_id."' ORDER BY timestamp_write;";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		$doesnthaveit = 1;
		
		if(mysqli_num_rows($result) > 0)
			$doesnthaveit = 0;
		
		if($doesnthaveit == 1 && $USERID2 == 0){
			Redirect($WWW_URL."user.php");
			die("You don't have acces here");
		}
		
		while($row = mysqli_fetch_row($result)){
			$name = ($row[2] == $row[7]) ? $row[8] : $lang['OWNER'];//Website owner
			if($row[2] != 0)
				$target_id = $row[2];
			if($name != $lang['OWNER'])
				$name = "<a href=\"http://steamcommunity.com/profiles/".getSteamID64($name)."/\" >".$name."</a>";
			$message = array(
				"sender"			=> $row[2],
				"text"				=> $row[4],
				"timestamp_write"	=> gmdate("Y-m-d H:i", $row[5]),
				"name"				=> $name
			);
			$message_list[] = $message;
		}
		$smarty->assign("message_list", $message_list);
		$smarty->assign("ticket_id", $ticket_id);
		
		//wysłanie ticketu
		if(isset($_POST['textofticket'])){
			$TicketText = mysql_escape_mimic(stripslashes($_POST['textofticket']));
		if((strpos($TicketText, 'drop') !== false) || (strpos($TicketText, 'table') !== false))
			$TicketText = "XD1";
		
		if(!preg_match("/^[^\\\'\`\%\-\"\;]+$/", $TicketText) || strlen($TicketText) < 1)
			$TicketText = "XD2";
		
		if(strlen($TicketText) > 200)
			$TicketText = "XD3";
		
			
			if($USERID2 == 0)
				$query = "INSERT INTO `".$TABLE_HELPDESK."` (id_ticket, sender, reciver, text, timestamp_write) VALUES ('".$ticket_id."', '".$USERID."', '0', '".$TicketText."', '".time()."');";
			else
				$query = "INSERT INTO `".$TABLE_HELPDESK."` (id_ticket, sender, reciver, text, timestamp_write) VALUES ('".$ticket_id."', '0', '".$target_id."', '".$TicketText."', '".time()."');";
			$result2 = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
			Redirect($WWW_URL."ticket.php?id=".$ticket_id);
		}
		
		if($USERID2 == 0)
			$query = "UPDATE ".$TABLE_HELPDESK." SET seen = 1 WHERE id_ticket = '".$ticket_id."' AND reciver = '".$USERID."';";//update czy widział
		else
			$query = "UPDATE ".$TABLE_HELPDESK." SET seen = 1 WHERE id_ticket = '".$ticket_id."' AND reciver = '0';";//update czy widział admin
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	}
	else{
		Redirect($WWW_URL."user.php");
		die("You don't have acces here");
	}
	
	$smarty->assign("TITLE", $lang['TITLE']);
	$smarty->assign("TITLE2", '');
	
	$smarty->assign("BACK", $lang['BACK']);
	$smarty->assign("TICKET", $lang['TICKET']);
	$smarty->assign("WETRY", $lang['WETRY']);
	$smarty->assign("REPLYTOUS", $lang['REPLYTOUS']);
	$smarty->assign("REPLY", $lang['REPLY']);
	$smarty->assign("OWNER", $lang['OWNER']);
		
	$smarty->assign("HOME", $lang['HOME']);
	$smarty->assign("PLUGINS", $lang['PLUGINS']);
	$smarty->assign("BUY", $lang['BUY']);
	$smarty->assign("USERP", $lang['USERP']);
	$smarty->assign("ADMIN", $lang['ADMIN']);
	$smarty->assign("GENERATORVIP", $lang['GENERATORVIP']);
	$smarty->assign("OPINIONS", $lang['OPINIONS']);
	
	//Funny quotes
	$smarty->assign("QUOTES", $lang['QUOTE'][array_rand($lang['QUOTE'])]);
	$smarty->assign("DESCRIPTION", $lang['DESCRIPTION']);
	$smarty->assign("KEYWORDS", $lang['KEYWORDS']);
	
	////Display HTML
	$smarty->display('_HEADER.tpl');
	$smarty->display('ticket.tpl');
	$smarty->display('_FOOTER.tpl');
?>