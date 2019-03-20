<?php
/* Smarty version 3.1.34-dev-7, created on 2019-03-20 14:19:30
  from 'D:\Programy\Folder\Xampp\htdocs\cs-plugin\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c923de2030350_02451506',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '68c12dc02e3ecafb09d9cd4045583148602180d6' => 
    array (
      0 => 'D:\\Programy\\Folder\\Xampp\\htdocs\\cs-plugin\\templates\\index.tpl',
      1 => 1552646577,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c923de2030350_02451506 (Smarty_Internal_Template $_smarty_tpl) {
?>		<div class="section no-pad-bot" id="index-banner" style="margin-top: 3em;">
			<div class="container">
				<img src="./assets/images/logov2nr3.png" style="width: 55%; display: block; margin: auto;"/>
				<h1 class="header center orange-text"><?php echo $_smarty_tpl->tpl_vars['TITLEPLUGINS']->value;?>
</h1>
				<div class="row center">
					<h5 class="header col s12 light"><?php echo $_smarty_tpl->tpl_vars['TITLESMALL']->value;?>
</h5>
				</div>
				<div class="row center">
<?php if ($_smarty_tpl->tpl_vars['login_button_main']->value == '') {?>
					<a href='?login'><img src='./assets/images/steamloginv2.png'></a>
<?php } else { ?>
					<a href="/plugins.php"><span class="btn-flat"><?php echo $_smarty_tpl->tpl_vars['LOOKAROUND']->value;?>
</span></a>
<?php }?>
				</div>
			</div>
		</div><?php }
}
