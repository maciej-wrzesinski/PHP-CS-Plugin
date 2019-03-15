<!DOCTYPE html>
<html lang="pl-PL">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title>{$TITLE} - {$TITLE2}</title>
		
		<meta name="description" content="{$DESCRIPTION}" />
		<meta name="keywords" content="{$KEYWORDS}" />
		<link rel="shortcut icon" href="./assets/images/faviconv2nr2.png" />

		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="./assets/css/materialize.css" />
		<link type="text/css" rel="stylesheet" href="./assets/css/style.css" />
		<link type="text/css" rel="stylesheet" href="./assets/css/service.css" />
		<link type="text/css" rel="stylesheet" href="./assets/css/plugins.css" />
		<link type="text/css" rel="stylesheet" href="./assets/css/sweetalert.css" />
		
	</head>
	<body>
		<div class="se-pre-con">
			<div style="text-align: center; height: 0; line-height: 6000%;">{$QUOTES}</div>
		</div>
		
		<nav class="lighten-1" role="navigation">
			<div class="nav-wrapper container">
				<ul class="left hide-on-med-and-down">
				<li>
					<a href="index.php">{$HOME}</a>
					<a href="plugins.php">{$PLUGINS}</a>
					<a href="buy.php" style="color: #fff;">{$BUY}</a>
					<a href="opinions.php">{$OPINIONS}</a>
				</li>
				</ul>
				<ul class="right hide-on-med-and-down">
					<li>
						<div class="right" style="margin-right: 0px; margin-top: 10px;">
							<a href="?lang=en" style="padding-right: 0px;"><img src="./assets/images/en.png"></a>
							<a href="?lang=pl" style="padding-right: 0px;"><img src="./assets/images/pl.png"></a>
						</div>
{if $isadmin != ""}
						<a href="admin.php" class='btn-flat'>{$ADMIN}</a>
{/if}
{if $logout_button_header != ""}
						<a href="user.php" class='btn-flat'>{$USERP}</a>
						<a href='?logout' class='btn-flat'>{$LOGOUT}</a>
{/if}
						<a href='?login' class='btn-flat'>{$LOGIN}</a>
					</li>
				</ul>
				<ul id="nav-mobile" class="side-nav" style="transform: translateX(-100%);">
					<li>
						<a href="index.php">{$HOME}</a>
						<a href="plugins.php">{$PLUGINS}</a>
						<a href="buy.php" style="color: #fff;">{$BUY}</a>
						<a href="opinions.php">{$OPINIONS}</a>
						<a href="#"></a>
{if $isadmin != ""}
						<a href="admin.php">{$ADMIN}</a>
{/if}
{if $logout_button_mobile != ""}
						<a href="user.php">{$USERP}</a>
						<a href='?logout'>{$LOGOUT}</a>
{/if}
						<a href='?login'>{$LOGIN}</a>
						<a href="#"></a>
						<a href="?lang=en" style="padding-right: 0px;"><img src="./assets/images/en.gif"> English</a>
						<a href="?lang=pl" style="padding-right: 0px;"><img src="./assets/images/pl.gif"> Polski</a>
					</li>
				</ul>
				<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
			</div>
		</nav>
