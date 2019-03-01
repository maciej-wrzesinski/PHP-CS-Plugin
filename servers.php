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
	
	
	if(isset($_GET['plugin']) && $_GET['plugin'] != "" && $_GET['plugin'] > 0){
		$plugin_id = mysql_escape_mimic(stripslashes($_GET['plugin']));
		
		$query = "SELECT * FROM ".$TABLE_LICENSES." WHERE plugin_id = '".$plugin_id."' AND user_id = '".$USERID."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		$doesnthaveit = 1;
		while($row = mysqli_fetch_row($result))
			$doesnthaveit = 0;
		
		if($doesnthaveit == 1){
			Redirect($WWW_URL."plugins.php");
			die("You don't have acces here");
		}
		if(isset($_POST['service_id'])){ // zapisanie nowych ip
			$servers = array();
			foreach($_POST['service_id'] as $key => $value)
				if(strpos($value, "127.0.0.1") === false && $value != "")
					$servers[] = $value;
			
			$goodip = 1;
			foreach($servers as $key => $value)
				if(!preg_match('/^(\d+\.\d+\.\d+\.\d+):(\d+)$/', $value) && $value != "")
					$goodip = 0;
			
			if($goodip){
				$smarty->assign("updated", "yes");
			
				$query = "DELETE FROM `".$TABLE_SERVERS."` WHERE id_of_owner = '".$USERID."' AND plugin_id = '".$plugin_id."';";//ID OWNERA BEDDZIE W SESJI
				$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
					
				if(count($servers) > 0){
					$query = "INSERT INTO `".$TABLE_SERVERS."` (ip, id_of_owner, plugin_id) VALUES";
					$i = 0;
					foreach($servers as $key => $value){
						if($value != ""){
							if($i > 0)
								$query .= ", ";
							$query .= "('".$value."', '".$USERID."', '".$plugin_id."')";
							$i = $i + 1;
						}
					}
					$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
				}
			}
			else
				$smarty->assign("notupdated", "yes");
		}
		
		//tylko nazwy potrzebne wyciaga
		$query = "SELECT name, id FROM ".$TABLE_PLUGINS." WHERE id = '".$plugin_id."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		while($row = mysqli_fetch_row($result)){
			$smarty->assign("plugin_name", $row[0]);
			$smarty->assign("plugin_id", $row[1]);
		}
		
		//wyciaga ip wszystkie z tego plugsa
		$query = "SELECT * FROM ".$TABLE_SERVERS." WHERE plugin_id = '".$plugin_id."' AND id_of_owner = '".$USERID."' order by ip desc;";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		$i = 0;
		while($row = mysqli_fetch_row($result)){
			$server = array(
				//0 to id
				"id"		=> $row[0],
				"number"	=> $i,
				"ip"		=> $row[1],
				"owner"		=> $row[2],
				"plugin_id"	=> $row[3]
			);
			$server_list[] = $server;
			$i = $i + 1;
		}
		$smarty->assign("server_list", $server_list);
		
		$smarty->assign("CONFIG", $lang['CONFIG']);
		$smarty->assign("UPDATED", $lang['UPDATED']);
		$smarty->assign("NOTUPDATED", $lang['NOTUPDATED']);
		$smarty->assign("ADDLIMIT", $lang['ADDLIMIT']);
		$smarty->assign("UPDATE", $lang['UPDATE']);
		$smarty->assign("BACK", $lang['BACK']);
	}
	else{
		Redirect($WWW_URL."plugins.php");
		die("You don't have acces here");
	}
	
	$smarty->assign("TITLE", $lang['TITLE']);
	$smarty->assign("TITLE2", '');
	
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
	$smarty->display('servers.tpl');
	$smarty->display('_FOOTER.tpl');
?>