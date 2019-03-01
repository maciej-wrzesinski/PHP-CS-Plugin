<?php require 'includes/steamauth/steamauth.php'; ?>
<?php
	include("config/global.php");
	include("includes/functions.php");
	include("includes/lang.php");
	include("config/db.php");
	
	////Smarty 
	require_once("smarty/Smarty.class.php");
	$smarty = new Smarty();
    $smarty->error_reporting = 0;

    $USERID = 0;
	if(!isset($_SESSION['steamid']))
	{
		$smarty->assign("loginbuttonn", "<a href='?login'>".$lang['LOGIN']."</a>");
		$smarty->assign("loginbutton2", "<a href='?login' class='btn-flat'>".$lang['LOGIN']."</a>");
		$smarty->assign("loginbutton", "<a href='?login'><img src='".$WWW_URL."assets/images/steamlogin.png'></a>");
	}
	else
	{
        $STEAMID = toSteamID($_SESSION['steamid']);

		$smarty->assign("logoutbutton", "<a href='?logout' class='btn-flat'>".$lang['LOGOUT']."</a>");
		$smarty->assign("logoutbuttonn", "<a href='?logout'>".$lang['LOGOUT']."</a>");
        include("includes/steamauth/userInfo.php");

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
	
	
	
	if($USERID > 0){
		$query = "SELECT opinion FROM `".$TABLE_USERS."` WHERE id = ".$USERID." order by id desc;";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		$row = mysqli_fetch_row($result);
		if($row[0] != "")
			$smarty->assign("alreadyopinion", "1");
		else
			$smarty->assign("alreadyopinion", "0");
	}
	else
		$smarty->assign("alreadyopinion", "1");
	
	$query = "SELECT * FROM `".$TABLE_USERS."` WHERE opinion <> '' order by id desc;";
	$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	while($row = mysqli_fetch_row($result)){
		$row[1] = "<a href=\"http://steamcommunity.com/profiles/".getSteamID64($row[1])."/\" >".$row[1]."</a>";
		$opinion = array(
			//0 to id
			"id"		=> $row[0],
			"steamekk"		=> $row[1],
			"opinion"	=> $row[3]
		);
		$opinion_list[] = $opinion;
	}
	$smarty->assign("opinion_list", $opinion_list);
	
	$smarty->assign("TITLE", $lang['TITLE']);
	$smarty->assign("TITLE2", $lang['OPINIONS']);
	
	$smarty->assign("HOME", $lang['HOME']);
	$smarty->assign("PLUGINS", $lang['PLUGINS']);
	$smarty->assign("BUY", $lang['BUY']);
	$smarty->assign("USERP", $lang['USERP']);
	$smarty->assign("ADMIN", $lang['ADMIN']);
	$smarty->assign("OPINIONS", $lang['OPINIONS']);
	
	$smarty->assign("OPINIONSABOUT", $lang['OPINIONSABOUT']);
	$smarty->assign("OPINIONSFROM", $lang['OPINIONSFROM']);
	$smarty->assign("SUBMITOPINION", $lang['SUBMITOPINION']);
	
	//Funny quotes
	$smarty->assign("QUOTES", $lang['QUOTE'][array_rand($lang['QUOTE'])]);
	$smarty->assign("DESCRIPTION", $lang['DESCRIPTION']);
	$smarty->assign("KEYWORDS", $lang['KEYWORDS']);
	
	////Display HTML
	$smarty->display('_HEADER.tpl');
	$smarty->display('opinions.tpl');
	$smarty->display('_FOOTER.tpl');
?>