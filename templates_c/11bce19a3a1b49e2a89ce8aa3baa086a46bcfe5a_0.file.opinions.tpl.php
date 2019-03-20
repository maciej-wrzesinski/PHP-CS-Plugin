<?php
/* Smarty version 3.1.34-dev-7, created on 2019-03-20 23:10:12
  from 'D:\Programy\Folder\Xampp\htdocs\cs-plugin\templates\opinions.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c92ba44942662_71278265',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '11bce19a3a1b49e2a89ce8aa3baa086a46bcfe5a' => 
    array (
      0 => 'D:\\Programy\\Folder\\Xampp\\htdocs\\cs-plugin\\templates\\opinions.tpl',
      1 => 1553119793,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c92ba44942662_71278265 (Smarty_Internal_Template $_smarty_tpl) {
?>		<div class="section no-pad-bot" id="index-banner">
			<div class="container">
				<h1 class="header center orange-text"><?php echo $_smarty_tpl->tpl_vars['OPINIONSABOUT']->value;?>
</h1>
				<div class="row center">
					<h5 class="header col s12 light"><?php echo $_smarty_tpl->tpl_vars['OPINIONSFROM']->value;?>
</h5>
				</div>
				<p class="hrr"></p>
<?php if ($_smarty_tpl->tpl_vars['logoutbutton']->value != '' && $_smarty_tpl->tpl_vars['alreadyopinion']->value == '') {?>
				<form method="POST" action="opinions.php" id="formValidate" class="formValidate col s12" style="margin: auto; margin-top: 150px; margin-bottom: 150px;">
					<div style="width: 70%; margin: auto;">
						<center><input class="textwindow" type="text" name="opinion" /></center>
					</div>
					<br />
					<center><button class="btn" type="submit" name="register" style="width: 250px;"><?php echo $_smarty_tpl->tpl_vars['SUBMITOPINION']->value;?>
<i class="material-icons right">keyboard_arrow_right</i></button></center>
				</form>
				<p class="hrr"></p>
<?php }?>
				<div style="margin-bottom: 200px;">
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['opinion_list']->value, 'opinionn');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['opinionn']->value) {
?>
					<div class="card-panel card-panel2">
						<span style="font-size: 12px;"><a href=\"http://steamcommunity.com/profiles/<?php echo $_smarty_tpl->tpl_vars['opinionn']->value['steamnumber'];?>
" ><?php echo $_smarty_tpl->tpl_vars['opinionn']->value['steamnumber'];?>
</a></span>
						<br /><br /><?php echo $_smarty_tpl->tpl_vars['opinionn']->value['opinion'];?>

					</div>
<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
					<div class="card-panel" style="width: 30%;
    margin: 10px;
    float: left;
    min-height: 200px;">
						<br /><br />
					</div>
					<div class="card-panel" style="width: 30%;
    margin: 10px;
    float: left;
    min-height: 200px;">
						<br /><br />
					</div>
					<div class="card-panel" style="width: 30%;
    margin: 10px;
    float: left;
    min-height: 200px;">
						<br /><br />
					</div>
				</div>
			</div>
		</div>
		<br><br><br><br><br><br><br>
		<!--Scripts Internal-->
		<?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-2.1.1.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="./assets/js/materialize.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="./assets/js/mixitup.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="./assets/js/opinion.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 type="text/javascript" src="./assets/js/jquery.validate.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 type="text/javascript" src="./assets/js/additional-methods.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 type="text/javascript" src="./assets/js/opinion.js"><?php echo '</script'; ?>
><?php }
}
