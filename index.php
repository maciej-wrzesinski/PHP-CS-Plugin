<?php require 'includes/steamauth/steamauth.php'; ?>
<?php
	include("config/global.php");
	include("includes/functions.php");
	include("includes/lang.php");
	
	////Smarty 
	require_once("smarty/Smarty.class.php");
	$smarty = new Smarty();
    $smarty->error_reporting = 0;

	if(!isset($_SESSION['steamid']))
	{
		$smarty->assign("loginbuttonn", "<a href='?login'>".$lang['LOGIN']."</a>");
		$smarty->assign("loginbutton2", "<a href='?login' class='btn-flat'>".$lang['LOGIN']."</a>");
		$smarty->assign("loginbutton", "<a href='?login'><img src='./assets/images/steamloginv2.png'></a>");
	}
	else
	{
        $STEAMID = toSteamID($_SESSION['steamid']);

		$smarty->assign("logoutbutton", "<a href='?logout' class='btn-flat'>".$lang['LOGOUT']."</a>");
		$smarty->assign("logoutbuttonn", "<a href='?logout'>".$lang['LOGOUT']."</a>");
		include("includes/steamauth/userInfo.php");
		include("config/db.php");
		
		$USERID = 0;
		$query = "SELECT id FROM `".$TABLE_USERS."` WHERE `sid` = '".$STEAMID."';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		while($row = mysqli_fetch_row($result))
			$USERID = $row[0];
		
		if($USERID == 0){//dodawanie usera
			$query = "INSERT INTO `".$TABLE_USERS."` (sid, level, opinion) VALUES ('".$STEAMID."', '0', '');";
			$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		}
		else{
			$query = "SELECT id FROM `".$TABLE_USERS."` WHERE `sid` = '".$STEAMID."' AND `level` = '1';";
			$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
			
			$USERID2 = 0;
			while($row = mysqli_fetch_row($result))
				$USERID2 = $row[0];
			
			if($USERID2 != 0){
				$smarty->assign("isadmin", "1");
			}
		}
	}
	
	$smarty->assign("TITLE", $lang['TITLE']);
	$smarty->assign("TITLE2", $lang['HOME']);
	
	$smarty->assign("HOME", $lang['HOME']);
	$smarty->assign("PLUGINS", $lang['PLUGINS']);
	$smarty->assign("BUY", $lang['BUY']);
	$smarty->assign("USERP", $lang['USERP']);
	$smarty->assign("ADMIN", $lang['ADMIN']);
	$smarty->assign("OPINIONS", $lang['OPINIONS']);
	
	$smarty->assign("TITLEPLUGINS", $lang['TITLEPLUGINS']);
	$smarty->assign("TITLESMALL", $lang['TITLESMALL']);
	$smarty->assign("LOOKAROUND", $lang['LOOKAROUND']);
	
	$smarty->assign("yesthisisindex", "1");
	
	//Funny quotes
	$smarty->assign("QUOTES", $lang['QUOTE'][array_rand($lang['QUOTE'])]);
	$smarty->assign("DESCRIPTION", $lang['DESCRIPTION']);
	$smarty->assign("KEYWORDS", $lang['KEYWORDS']);
	
	////Display HTML
	$smarty->display('_HEADER.tpl');
	$smarty->display('index.tpl');
	$smarty->display('_FOOTER.tpl');
?>