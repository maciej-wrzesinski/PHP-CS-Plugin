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
        $_SESSION['steamid'] = $login->logout();
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

    $fileLang = $lang->getCurrentLanguage();
    include_once(dirname(__FILE__).'/languages/'.$fileLang.'.php');


    /*
     * Something handling
     */
    if(!isset($_SESSION['steamid']) || $_SESSION['steamid'] === 'fail')
    {
        $template->assignVariable("loginbuttonn", "<a href='?login'>".$lang['LOGIN']."</a>");
        $template->assignVariable("loginbutton2", "<a href='?login' class='btn-flat'>".$lang['LOGIN']."</a>");
        $template->assignVariable("loginbutton", "<a href='?login'><img src='./assets/images/steamloginv2.png'></a>");
    }
    else
    {
        $STEAMID = toSteamID($_SESSION['steamid']);

        $smarty->assignVariable("logoutbutton", "<a href='?logout' class='btn-flat'>".$lang['LOGOUT']."</a>");
        $smarty->assignVariable("logoutbuttonn", "<a href='?logout'>".$lang['LOGOUT']."</a>");
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
                $smarty->assignVariable("isadmin", "1");
            }
        }
    }


    /*
     * This is something that will change for sure with every subpage
     */
    $template->assignVariable("TITLE2", $lang['HOME']);


    /*
     * Show HTML
     */
    $fileName = basename(__FILE__, '.php');
    $template->displayHTML($fileName);

/*
	include("config/global.php");
	include("includes/functions.php");
	
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

	

	
	//Funny quotes
	$smarty->assign("QUOTES", $lang['QUOTE'][array_rand($lang['QUOTE'])]);
	$smarty->assign("DESCRIPTION", $lang['DESCRIPTION']);
	$smarty->assign("KEYWORDS", $lang['KEYWORDS']);

    */