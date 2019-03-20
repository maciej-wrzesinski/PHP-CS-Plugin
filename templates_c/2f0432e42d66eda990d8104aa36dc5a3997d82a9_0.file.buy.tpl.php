<?php
/* Smarty version 3.1.34-dev-7, created on 2019-03-20 15:00:48
  from 'D:\Programy\Folder\Xampp\htdocs\cs-plugin\templates\buy.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c924790dd4d08_41268023',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2f0432e42d66eda990d8104aa36dc5a3997d82a9' => 
    array (
      0 => 'D:\\Programy\\Folder\\Xampp\\htdocs\\cs-plugin\\templates\\buy.tpl',
      1 => 1544540958,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c924790dd4d08_41268023 (Smarty_Internal_Template $_smarty_tpl) {
?>		<div class="section no-pad-bot" id="index-banner">
			<div class="container">
				<h1 class="header center orange-text"><?php echo $_smarty_tpl->tpl_vars['YALIKE']->value;?>
</h1>
				<div class="row center">
					<h5 class="header col s12 light"><?php echo $_smarty_tpl->tpl_vars['CONTACTUS']->value;?>
</h5>
				</div>

	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['author_list']->value, 'author');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['author']->value) {
?>
				- <a href="<?php echo $_smarty_tpl->tpl_vars['author']->value['link'];?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['author']->value['name'];?>
</a><br /><br />
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				
				<p class="hrr"></p><br />
				
				<div class="row center">
					<h5 class="header col s12 light"><?php echo $_smarty_tpl->tpl_vars['WHYUS']->value;?>
</h5>
				</div>
				
				<?php echo $_smarty_tpl->tpl_vars['WHYUS1']->value;?>
<br />
				<?php echo $_smarty_tpl->tpl_vars['WHYUS2']->value;?>
<br />
				<?php echo $_smarty_tpl->tpl_vars['WHYUS3']->value;?>
<br />
				<?php echo $_smarty_tpl->tpl_vars['WHYUS4']->value;?>
<br /><br />
				
				<p class="hrr"></p><br />
				
				<div class="row center">
					<h5 class="header col s12 light"><?php echo $_smarty_tpl->tpl_vars['MORE']->value;?>
</h5>
				</div>
				<br />
				<?php echo $_smarty_tpl->tpl_vars['MOREPLUGINS']->value;?>

				
				<br /><br />
			</div>
		</div><?php }
}
