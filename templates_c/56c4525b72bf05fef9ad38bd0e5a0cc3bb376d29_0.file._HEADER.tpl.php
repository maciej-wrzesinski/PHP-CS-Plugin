<?php
/* Smarty version 3.1.34-dev-7, created on 2019-03-20 14:19:29
  from 'D:\Programy\Folder\Xampp\htdocs\cs-plugin\templates\_HEADER.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c923de1ebec02_17975520',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '56c4525b72bf05fef9ad38bd0e5a0cc3bb376d29' => 
    array (
      0 => 'D:\\Programy\\Folder\\Xampp\\htdocs\\cs-plugin\\templates\\_HEADER.tpl',
      1 => 1552646560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c923de1ebec02_17975520 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="pl-PL">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
		<title><?php echo $_smarty_tpl->tpl_vars['TITLE']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['TITLE2']->value;?>
</title>
		
		<meta name="description" content="<?php echo $_smarty_tpl->tpl_vars['DESCRIPTION']->value;?>
" />
		<meta name="keywords" content="<?php echo $_smarty_tpl->tpl_vars['KEYWORDS']->value;?>
" />
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
			<div style="text-align: center; height: 0; line-height: 6000%;"><?php echo $_smarty_tpl->tpl_vars['QUOTES']->value;?>
</div>
		</div>
		
		<nav class="lighten-1" role="navigation">
			<div class="nav-wrapper container">
				<ul class="left hide-on-med-and-down">
				<li>
					<a href="index.php"><?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
</a>
					<a href="plugins.php"><?php echo $_smarty_tpl->tpl_vars['PLUGINS']->value;?>
</a>
					<a href="buy.php" style="color: #fff;"><?php echo $_smarty_tpl->tpl_vars['BUY']->value;?>
</a>
					<a href="opinions.php"><?php echo $_smarty_tpl->tpl_vars['OPINIONS']->value;?>
</a>
				</li>
				</ul>
				<ul class="right hide-on-med-and-down">
					<li>
						<div class="right" style="margin-right: 0px; margin-top: 10px;">
							<a href="?lang=en" style="padding-right: 0px;"><img src="./assets/images/en.png"></a>
							<a href="?lang=pl" style="padding-right: 0px;"><img src="./assets/images/pl.png"></a>
						</div>
<?php if ($_smarty_tpl->tpl_vars['isadmin']->value != '') {?>
						<a href="admin.php" class='btn-flat'><?php echo $_smarty_tpl->tpl_vars['ADMIN']->value;?>
</a>
<?php }
if ($_smarty_tpl->tpl_vars['logout_button_header']->value != '') {?>
						<a href="user.php" class='btn-flat'><?php echo $_smarty_tpl->tpl_vars['USERP']->value;?>
</a>
						<a href='?logout' class='btn-flat'><?php echo $_smarty_tpl->tpl_vars['LOGOUT']->value;?>
</a>
<?php }?>
						<a href='?login' class='btn-flat'><?php echo $_smarty_tpl->tpl_vars['LOGIN']->value;?>
</a>
					</li>
				</ul>
				<ul id="nav-mobile" class="side-nav" style="transform: translateX(-100%);">
					<li>
						<a href="index.php"><?php echo $_smarty_tpl->tpl_vars['HOME']->value;?>
</a>
						<a href="plugins.php"><?php echo $_smarty_tpl->tpl_vars['PLUGINS']->value;?>
</a>
						<a href="buy.php" style="color: #fff;"><?php echo $_smarty_tpl->tpl_vars['BUY']->value;?>
</a>
						<a href="opinions.php"><?php echo $_smarty_tpl->tpl_vars['OPINIONS']->value;?>
</a>
						<a href="#"></a>
<?php if ($_smarty_tpl->tpl_vars['isadmin']->value != '') {?>
						<a href="admin.php"><?php echo $_smarty_tpl->tpl_vars['ADMIN']->value;?>
</a>
<?php }
if ($_smarty_tpl->tpl_vars['logout_button_mobile']->value != '') {?>
						<a href="user.php"><?php echo $_smarty_tpl->tpl_vars['USERP']->value;?>
</a>
						<a href='?logout'><?php echo $_smarty_tpl->tpl_vars['LOGOUT']->value;?>
</a>
<?php }?>
						<a href='?login'><?php echo $_smarty_tpl->tpl_vars['LOGIN']->value;?>
</a>
						<a href="#"></a>
						<a href="?lang=en" style="padding-right: 0px;"><img src="./assets/images/en.gif"> English</a>
						<a href="?lang=pl" style="padding-right: 0px;"><img src="./assets/images/pl.gif"> Polski</a>
					</li>
				</ul>
				<a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
			</div>
		</nav>
<?php }
}
