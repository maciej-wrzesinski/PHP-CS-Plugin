<?php
/* Smarty version 3.1.34-dev-7, created on 2019-03-12 11:30:43
  from 'D:\Programy\Folder\Xampp\htdocs\cs-plugin\templates\_FOOTER.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_5c878a53689a65_22942166',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6b3c1dfebf5dc7c2e92e24b8b4c60abae03cb7c4' => 
    array (
      0 => 'D:\\Programy\\Folder\\Xampp\\htdocs\\cs-plugin\\templates\\_FOOTER.tpl',
      1 => 1552386370,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c878a53689a65_22942166 (Smarty_Internal_Template $_smarty_tpl) {
?>
		<footer class="page-footer">
			<div class="footer-copyright">
				<div class="container">
					<center>© 2017 <a class="orange-text text-lighten-3" href="#">CS-Plugin.com</a> All rights reserved.</center>
				</div>
			</div>
		</footer>

	  <!--  Scripts-->
	  <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-2.1.1.min.js"><?php echo '</script'; ?>
>
	  <?php echo '<script'; ?>
 src="assets/js/materialize.js"><?php echo '</script'; ?>
>
	  <?php echo '<script'; ?>
 src="assets/js/init.js"><?php echo '</script'; ?>
>
	  <?php echo '<script'; ?>
 src="assets/js/sweetalert.min.js"><?php echo '</script'; ?>
>
	  <?php echo '<script'; ?>
>
		$(window).load(function() {
			$(".se-pre-con").delay(600).fadeOut(600);;
		});
	  <?php echo '</script'; ?>
>
	</body>
</html><?php }
}
