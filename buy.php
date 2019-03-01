<?php require 'includes/steamauth/steamauth.php'; ?>
<?php
	include("config/db.php");
	include("config/global.php");
	include("includes/functions.php");
	include("includes/lang.php");
	
	////Smarty 
	require_once("smarty/Smarty.class.php");
	$smarty=new Smarty();
    $smarty->error_reporting = 0;

	if(!isset($_SESSION['steamid'])){
		$smarty->assign("loginbuttonn", "<a href='?login'>".$lang['LOGIN']."</a>");
		$smarty->assign("loginbutton2", "<a href='?login' class='btn-flat'>".$lang['LOGIN']."</a>");
	}  else {
        $STEAMID = toSteamID($_SESSION['steamid']);
		$smarty->assign("logoutbutton", "<a href='?logout' class='btn-flat'>".$lang['LOGOUT']."</a>");
		$smarty->assign("logoutbuttonn", "<a href='?logout'>".$lang['LOGOUT']."</a>");
		include ('includes/steamauth/userInfo.php');
		
		$query = "SELECT id FROM `".$TABLE_USERS."` WHERE `sid` = '".$STEAMID."' AND `level` = '1';";
		$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
		
		while($row = mysqli_fetch_row($result))
			$USERID = $row[0];
		
		if($USERID != 0){
			$smarty->assign("isadmin", "1");
		}
		
	}
	
	$query = "SELECT * FROM `".$TABLE_AUTHORS."`;";
	$result = mysqli_query($sql, $query) or die("Connection error".mysqli_error($sql));
	
	$i = 0;
	while($row = mysqli_fetch_row($result)){
		if($i == 3) break;
		$author = array(
			"name"	=> $row[1],
			"link"	=> $row[2]
		);
		$author_list[] = $author;
		$i += 1;
	}
	$smarty->assign("author_list", $author_list);
	
	$smarty->assign("TITLE", $lang['TITLE']);
	$smarty->assign("TITLE2", $lang['BUY']);
	
	$smarty->assign("HOME", $lang['HOME']);
	$smarty->assign("PLUGINS", $lang['PLUGINS']);
	$smarty->assign("BUY", $lang['BUY']);
	$smarty->assign("USERP", $lang['USERP']);
	$smarty->assign("ADMIN", $lang['ADMIN']);
	$smarty->assign("OPINIONS", $lang['OPINIONS']);
	
	$smarty->assign("YALIKE", $lang['YALIKE']);
	$smarty->assign("CONTACTUS", $lang['CONTACTUS']);
	$smarty->assign("WHYUS", $lang['WHYUS']);
	$smarty->assign("WHYUS1", $lang['WHYUS1']);
	$smarty->assign("WHYUS2", $lang['WHYUS2']);
	$smarty->assign("WHYUS3", $lang['WHYUS3']);
	$smarty->assign("WHYUS4", $lang['WHYUS4']);
	$smarty->assign("MORE", $lang['MORE']);
	$smarty->assign("MOREPLUGINS", $lang['MOREPLUGINS']);
	
	//Funny quotes
	$smarty->assign("QUOTES", $lang['QUOTE'][array_rand($lang['QUOTE'])]);
	$smarty->assign("DESCRIPTION", $lang['DESCRIPTION']);
	$smarty->assign("KEYWORDS", $lang['KEYWORDS']);
	
	////Display HTML
	$smarty->display('_HEADER.tpl');
	$smarty->display('buy.tpl');
	$smarty->display('_FOOTER.tpl');
?>