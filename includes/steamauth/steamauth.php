<?php
ob_start();
session_start();

function Redirect2($url) {
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=".$url."\">";
}
	
function logoutbutton() {
	return "<a href='?logout' class='btn-flat'>Wyloguj się</a>"; //logout button
}

function loginbutton($buttonstyle = "square") {
	return "<a href='?login'><img src='http://cs-plugin.com/assets/images/steamlogin.png'></a>";
	//$button['rectangle'] = "01";
	//$button['square'] = "02";
	//$button = "<a href='?login'><img src='http".(isset($_SERVER['HTTPS']) ? "s" : "")."://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_".$button[$buttonstyle].".png'></a>";
	//
	//echo $button;
}

if (isset($_GET['login'])){
	require 'openid.php';
	try {
		require 'SteamConfig.php';
		$openid = new LightOpenID($steamauth['domainname']);
		
		if(!$openid->mode) {
			$openid->identity = 'https://steamcommunity.com/openid';
			Redirect2($openid->authUrl());
			//header('Location: ' . $openid->authUrl());
		} elseif ($openid->mode == 'cancel') {
			echo 'User has canceled authentication!';
		} else {
			if($openid->validate()) { 
				$id = $openid->identity;
				$ptn = "/^https?:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
				preg_match($ptn, $id, $matches);
				
				$_SESSION['steamid'] = $matches[1];
				if (!headers_sent()) {
					Redirect2($steamauth['loginpage']);
					//header('Location: '.$steamauth['loginpage']);
					//exit;
				} else {
					?>
					<script type="text/javascript">
						window.location.href="<?=$steamauth['loginpage']?>";
					</script>
					<noscript>
						<meta http-equiv="refresh" content="0;url=<?=$steamauth['loginpage']?>" />
					</noscript>
					<?php
					//exit;
				}
			} else {
				echo "User is not logged in.\n";
			}
		}
	} catch(ErrorException $e) {
		echo $e->getMessage();
	}
}

if (isset($_GET['logout'])){
	require 'SteamConfig.php';
	session_unset();
	session_destroy();
	Redirect2($steamauth['logoutpage']);
	//header('Location: '.$steamauth['logoutpage']);
	//exit;
}

if (isset($_GET['update'])){
	unset($_SESSION['steam_uptodate']);
	require 'userInfo.php';
	Redirect2($_SERVER['PHP_SELF']);
	//header('Location: '.$_SERVER['PHP_SELF']);
	//exit;
}

// Version 3.2

?>
