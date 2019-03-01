<?php require 'includes/steamauth/steamauth.php'; ?>
<?php
	include("config/global.php");
	include("config/db.php");
	include("includes/functions.php");
	include("includes/lang.php");
	
	////Smarty 
	require_once("smarty/Smarty.class.php");
	$smarty = new Smarty();
    $smarty->error_reporting = 0;
	
	$USERID = 0;
	if(!isset($_SESSION['steamid'])){
		$smarty->assign("loginbuttonn", "<a href='?login'>".$lang['LOGIN']."</a>");
		$smarty->assign("loginbutton2", "<a href='?login' class='btn-flat'>".$lang['LOGIN']."</a>");
	}  else {
        $STEAMID = toSteamID($_SESSION['steamid']);
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
	
	$query = "SELECT * FROM `".$TABLE_PLUGINS."` INNER JOIN `".$TABLE_AUTHORS."` ON `".$TABLE_PLUGINS."`.`author` = `".$TABLE_AUTHORS."`.`id` order by price desc;";
	$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	
	while($row = mysqli_fetch_row($result)){
		
		$query2 = "SELECT * FROM `".$TABLE_LICENSES."` WHERE plugin_id = '".$row[0]."' AND user_id = '".$USERID."';";
		$result2 = mysqli_query($sql, $query2) or die("Connection error".mysqli_error($sql));
		$hasthisplugin = 0;
		while($row2 = mysqli_fetch_row($result2)){
			$hasthisplugin = 1;
		}
		
		if($lang_file == 'lang.pl.php')
			$plugin = array(
				//0 to id
				"id"		=> $row[0],
				"author"	=> $row[1],
				"name"		=> $row[2],
				"short_name"=> $row[3],
				"price"		=> $row[4],
				"price_euro" => round(((int)$row[4])/4.5, 0),
				"price_dolar" => round(((int)$row[4])/3.5, 0),
				"time"		=> $row[5],
				"link"		=> $row[6],
				"desc"		=> $row[8],
				"author_name"	=> $row[10],
				"author_sid"	=> $row[11],
				"hasthisplugin"	=> $hasthisplugin
			);
		else
			$plugin = array(
				//0 to id
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
				"hasthisplugin"	=> $hasthisplugin
			);
		$plugin_list[] = $plugin;
	}
	
	/* Próba fajnych URL
	if($_GET['id'] != '' && isset($_GET['id']) && $_GET['name'] && isset($_GET['id'])){
		if(preg_match("/^[a-zA-Z_]+$/", $_GET['name']) && preg_match("/^[\d]+$/", $_GET['id']) && strlen($_GET['name']) < 25 && strlen($_GET['id']) < 4 && strlen($_GET['name']) > 3 && strlen($_GET['id']) > 0){
			$smarty->assign("activeplugin", $_GET['id']);
		}
		else{
			Redirect($WWW_URL);
			die("What the hell?");
		}
	}*/
	
	$smarty->assign("plugin_list", $plugin_list);
	
	$smarty->assign("TITLE", $lang['TITLE']);
	$smarty->assign("TITLE2", $lang['PLUGINS']);
	
	$smarty->assign("HOME", $lang['HOME']);
	$smarty->assign("PLUGINS", $lang['PLUGINS']);
	$smarty->assign("BUY", $lang['BUY']);
	$smarty->assign("USERP", $lang['USERP']);
	$smarty->assign("ADMIN", $lang['ADMIN']);
	$smarty->assign("OPINIONS", $lang['OPINIONS']);
	
	$smarty->assign("LIST", $lang['LIST']);
	$smarty->assign("FREE", $lang['FREE']);
	$smarty->assign("AUTHOR", $lang['AUTHOR']);
	$smarty->assign("CONTACT", $lang['CONTACT']);
	$smarty->assign("DESC", $lang['DESC']);
	$smarty->assign("PRICE", $lang['PRICE']);
	$smarty->assign("EDITSERV", $lang['EDITSERV']);
	$smarty->assign("DOWNLOAD", $lang['DOWNLOAD']);
	$smarty->assign("NODOWNLOAD", $lang['NODOWNLOAD']);
	$smarty->assign("BUY", $lang['BUY']);
	$smarty->assign("LOGINDOWNLOAD", $lang['LOGINDOWNLOAD']);
	$smarty->assign("DISCLAMER", $lang['DISCLAMER']);
	$smarty->assign("DISCLAMERDESC", $lang['DISCLAMERDESC']);
	$smarty->assign("PLUGINS", $lang['PLUGINS']);
	$smarty->assign("PLUGINS2", $lang['PLUGINS2']);
	
	//Funny quotes
	$smarty->assign("QUOTES", $lang['QUOTE'][array_rand($lang['QUOTE'])]);
	$smarty->assign("DESCRIPTION", $lang['DESCRIPTION']);
	$smarty->assign("KEYWORDS", $lang['KEYWORDS']);
	
	////Display HTML
	$smarty->display('_HEADER.tpl');
	$smarty->display('plugins.tpl');
	$smarty->display('_FOOTER.tpl');
?>