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
		
		$query = "SELECT id FROM `".$TABLE_USERS."` WHERE `sid` = '".$STEAMID."' AND `level` = '1';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		while($row = mysqli_fetch_row($result))
			$USERID = $row[0];
		
		if($USERID == 0){
			Redirect($WWW_URL);
			die("You don't have acces here");
		}
		else
			$smarty->assign("isadmin", "1");
	}
	
	//Lista pluginów 
	$query = "SELECT * FROM `".$TABLE_PLUGINS."` WHERE `price` <> '0';";
	$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	while($row = mysqli_fetch_row($result)){
		$plugin = array(
			"name"	=> $row[2],
			"id"	=> $row[0]
		);
		$plugin_list[] = $plugin;
	}
	$smarty->assign("plugin_list", $plugin_list);
	
	//Lista ticketów
	$query = "SELECT tbl.id, tbl.id_ticket, tbl.sender, tbl.reciver, tbl.text, tbl.timestamp_write, tbl.seen 
		FROM `".$TABLE_HELPDESK."` AS tbl
		INNER JOIN 
		(SELECT id_ticket,max(timestamp_write) as lastest FROM `".$TABLE_HELPDESK."` WHERE `reciver` = '0' GROUP BY id_ticket) AS tbl2
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
	$smarty->assign("ticket_list", $ticket_list);
	
	$smarty->assign("TITLE", $lang['TITLE']);
	$smarty->assign("TITLE2", $lang['ADMIN']);
	
	$smarty->assign("HOME", $lang['HOME']);
	$smarty->assign("PLUGINS", $lang['PLUGINS']);
	$smarty->assign("BUY", $lang['BUY']);
	$smarty->assign("USERP", $lang['USERP']);
	$smarty->assign("ADMIN", $lang['ADMIN']);
	$smarty->assign("OPINIONS", $lang['OPINIONS']);
	
	$smarty->assign("YOURLICENSES", $lang['YOURLICENSES']);
	$smarty->assign("CLICKIP", $lang['CLICKIP']);
	$smarty->assign("NOLICENSES", $lang['NOLICENSES']);
	$smarty->assign("BUYSOME", $lang['BUYSOME']);
	
	$smarty->assign("ID", $lang['ID']);
	$smarty->assign("TEXT", $lang['TEXT']);
	$smarty->assign("WRITTEN", $lang['WRITTEN']);
	$smarty->assign("STATUS", $lang['STATUS']);
	$smarty->assign("SEEN", $lang['SEEN']);
	$smarty->assign("PENDING", $lang['PENDING']);
	$smarty->assign("HELPDESK", $lang['HELPDESK']);
	
	//dodawanie licki
	if(isset($_POST['formsteamid']) && isset($_POST['formpluginid'])){
		$steam_id = mysql_escape_mimic($_POST['formsteamid']);
		$plugin_id = mysql_escape_mimic($_POST['formpluginid']);
		
		//Dodaje usera
		$addid = 0;
		$query = "SELECT id FROM `".$TABLE_USERS."` WHERE sid = '".$steam_id."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		while($row = mysqli_fetch_row($result))
			$addid = $row[0];
		
		if($addid == 0){
			$query = "INSERT INTO `".$TABLE_USERS."` (sid, level) VALUES ('".$steam_id."', '0')";
			$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
			
			if($result === true){
				$query = "SELECT id FROM `".$TABLE_USERS."` WHERE sid = '".$steam_id."';";
				$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
				while($row = mysqli_fetch_row($result))
					$addid = $row[0];
			}
		}
		
		//sprawdzenie czy ma juz licke
		$haslicka = 0;
		$query = "SELECT * FROM `".$TABLE_LICENSES."` WHERE user_id = '".$addid."' AND plugin_id = '".$plugin_id."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		while($row = mysqli_fetch_row($result))
			$haslicka = $row[0];
		
		if($haslicka == 0){
			$query = "INSERT INTO `".$TABLE_LICENSES."` (plugin_id, user_id) VALUES('".$plugin_id."', '".$addid ."')";
			$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
			$smarty->assign("licenseinfo", "1");
		}
		else
			$smarty->assign("licenseinfo", "0");
	}
	
	//usuwanie licki
	if(isset($_POST['formdeletesteamid']) && isset($_POST['formdeletepluginid']) && isset($_POST['formdeleteuserid'])){
		$steam_id = mysql_escape_mimic($_POST['formdeletesteamid']);
		$plugin_id = mysql_escape_mimic($_POST['formdeletepluginid']);
		$user_id = mysql_escape_mimic($_POST['formdeleteuserid']);
		
		$query = "DELETE FROM `".$TABLE_SERVERS."` WHERE `id_of_owner` = '".$user_id."' AND `plugin_id` = '".$plugin_id."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		$query = "DELETE FROM `".$TABLE_LICENSES."` WHERE `user_id` = '".$user_id."' AND `plugin_id` = '".$plugin_id."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		if($result)
			$smarty->assign("deletelicenseinfo", "1");
		else
			$smarty->assign("deletelicenseinfo", "0");
	}
	
	//dodawanie pluginu
	if(isset($_POST['formauthorid']) && isset($_POST['formname']) && isset($_POST['formuniqueshort'])){
		echo ":OOL";
		$authid = mysql_escape_mimic($_POST['formauthorid']);
		$name = mysql_escape_mimic($_POST['formname']);
		$short_name = mysql_escape_mimic($_POST['formuniqueshort']);
		
		$addid = 0;
		$query = "SELECT id, name, short_name FROM `".$TABLE_PLUGINS."` WHERE name = '".$name."' OR short_name = '".$short_name."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		while($row = mysqli_fetch_row($result))
			$addid = $row[0];
		
		if($addid != 0)
			$smarty->assign("addplugnoname", "1");
		else{
			$query = "INSERT INTO `".$TABLE_PLUGINS."` (author, name, short_name) VALUES ('".$authid."', '".$name."', '".$short_name."');";
			$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
			
			if($result)
				$smarty->assign("addplugsucc", "1");
			else
				$smarty->assign("addplugfail", "1");
		}
	}
	
	//update pluginow
	if(isset($_POST['updateformid']) && isset($_POST['updateformname']) && isset($_POST['updateformprice'])&& isset($_POST['updateformlink']) && isset($_POST['updateformdesc']) && isset($_POST['updateformdescpl'])){
		$name = mysql_escape_mimic($_POST['updateformname']);
		$id = mysql_escape_mimic($_POST['updateformid']);
		$price = mysql_escape_mimic($_POST['updateformprice']);
		$link = mysql_escape_mimic($_POST['updateformlink']);
		$desc = $_POST['updateformdesc'];
		$descpl = $_POST['updateformdescpl'];
		
		$query = "UPDATE `".$TABLE_PLUGINS."` SET `price` = '".$price."', `name` = '".$name."', `link` = '".$link."', `description` = '".$desc."', `description_pl` = '".$descpl."' WHERE `id` = '".$id."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		if($result)
			$smarty->assign("updatepluginfo", "1");
		else
			$smarty->assign("updatepluginfo", "0");
	}
	
	//do dodawania plugsow
	$query = "SELECT * FROM `".$TABLE_AUTHORS."`;";
	$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	while($row = mysqli_fetch_row($result)){
		$author = array(
			"id"		=> $row[0],
			"name"		=> $row[1]
		);
		$author_list[] = $author;
	}
	$smarty->assign("author_list", $author_list);
	
	//przegladanie licek
	$query = "SELECT * FROM `".$TABLE_PLUGINS."` WHERE price > 0;";
	$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	while($row = mysqli_fetch_row($result)){
		
		$query2 = "SELECT * FROM `".$TABLE_LICENSES."` INNER JOIN `".$TABLE_USERS."` ON `".$TABLE_USERS."`.`id` = `".$TABLE_LICENSES."`.`user_id` WHERE plugin_id = '".$row[0]."';";
		$result2 = mysqli_query($sql, $query2) or die("Connection error".mysqli_error($sql));
		$hasthisplugin = 0;
		
		$user_list = array();
		
		while($row2 = mysqli_fetch_row($result2)){
			$user = array(
				"id"	=> $row2[3],
				"steamid"	=> $row2[4]
			);
			$user_list[] = $user;
		}
		
		$plugin = array(
			"id"		=> $row[0],
			"name"		=> $row[2],
			"users"		=> $user_list
		);
		$pluginusers_list[] = $plugin;
	}
	$smarty->assign("pluginusers_list", $pluginusers_list);
	
	//przegladanie pluginow
	$query = "SELECT * FROM `".$TABLE_PLUGINS."` order by price desc;";
	$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	while($row = mysqli_fetch_row($result)){
		$plugin = array(
			//0 to id
			"id"		=> $row[0],
			"author"	=> $row[1],
			"name"		=> $row[2],
			"short_name"=> $row[3],
			"price"		=> $row[4],
			"time"		=> $row[5],
			"link"		=> $row[6],
			"desc"		=> $row[7],
			"descpl"	=> $row[8]
		);
		$plugins_list[] = $plugin;
	}
	$smarty->assign("plugins_list", $plugins_list);
	
	$smarty->assign("ADDLIC", $lang['ADDLIC']);
	$smarty->assign("SUCCESLIC", $lang['SUCCESLIC']);
	$smarty->assign("FAILLIC", $lang['FAILLIC']);
	$smarty->assign("VIEWLIC", $lang['VIEWLIC']);
	$smarty->assign("ADD", $lang['ADD']);
	$smarty->assign("PANEL", $lang['PANEL']);
	$smarty->assign("EDITPLUG", $lang['EDITPLUG']);
	$smarty->assign("DELLICENCEFAIL", $lang['DELLICENCEFAIL']);
	$smarty->assign("DELLICENCESUCC", $lang['DELLICENCESUCC']);
	$smarty->assign("INFOFAILEDIT", $lang['INFOFAILEDIT']);
	$smarty->assign("INFOSUCCEDIT", $lang['INFOSUCCEDIT']);
	$smarty->assign("ADDPLUG", $lang['ADDPLUG']);
	$smarty->assign("NAMETAKEN", $lang['NAMETAKEN']);
	$smarty->assign("PLUGADDED", $lang['PLUGADDED']);
	$smarty->assign("FAILEDADDPLUG", $lang['FAILEDADDPLUG']);
	$smarty->assign("AUTHOR", $lang['AUTHOR']);
	$smarty->assign("THENAME", $lang['THENAME']);
	$smarty->assign("UQSHORT", $lang['UQSHORT']);
	$smarty->assign("URL", $lang['URL']);
	$smarty->assign("DESCPL", $lang['DESCPL']);
	$smarty->assign("PRICE", $lang['PRICE']);
	$smarty->assign("DESC", $lang['DESC']);
	
	//Funny quotes
	$smarty->assign("QUOTES", $lang['QUOTE'][array_rand($lang['QUOTE'])]);
	$smarty->assign("DESCRIPTION", $lang['DESCRIPTION']);
	$smarty->assign("KEYWORDS", $lang['KEYWORDS']);
	
	////Display HTML
	$smarty->display('_HEADER.tpl');
	$smarty->display('admin.tpl');
	$smarty->display('_FOOTER.tpl');
?>