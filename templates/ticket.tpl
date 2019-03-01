		<div class="section no-pad-bot" id="index-banner">
			<div class="container">
				<h1 class="header center orange-text">{$TICKET} #{$ticket_id}</h1>
{if $isadmin != "1"}
				<div class="row center">
					<h5 class="header col s12 light">{$WETRY}</h5>
				</div>
{/if}
				<p class="hrr"></p>
				<br />
				<div style="width: 80%; margin: auto;">
{foreach $message_list item=message}
	{if $message.sender == 0}
					<div class="card-panel card-panel2" style="width: 60%; margin-bottom: 20px; display: inline-block; background: #333; float: right;">
	{else}
					<div class="card-panel card-panel2" style="width: 60%; margin-bottom: 20px; display: inline-block;">
	{/if}
						<span style="font-size: 12px;">{$message.name}</span><span style="font-size: 12px; float: right;">{$message.timestamp_write}</span>
						<br /><br />{$message.text}
					</div>
{/foreach} 
					<br />
					<div class="row center">
{if $isadmin != "1"}
						<h5 class="header col s12 light">{$REPLYTOUS}</h5>
{/if}
					</div>
					<br />
					<form method="POST" action="ticket.php?id={$ticket_id}" id="formValidate" class="formValidate col s12" style="margin: auto;">
						<div style="width: 70%; margin: auto;">
							<center><input class="textwindow" type="text" name="textofticket" /></center>
						</div>
						<br />
						<center><button class="btn" type="submit" name="register" style="width: 250px;">{$REPLY}<i class="material-icons right">keyboard_arrow_right</i></button></center>
					</form>
				</div>
				
				<div class="fixed-action-btn">
{if $isadmin == "1"}
					<a href="admin.php" class="btn-floating btn-large tooltipped" data-tooltip="{$BACK}" data-position="top">
{else}
					<a href="user.php" class="btn-floating btn-large tooltipped" data-tooltip="{$BACK}" data-position="top">
{/if}
						<i class="large material-icons">keyboard_arrow_left</i>
					</a>
				</div>
			</div>
		</div>
		<!--Scripts Internal-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="assets/js/materialize.js"></script>
		<script src="assets/js/mixitup.min.js"></script>
		<script src="assets/js/opinion.js"></script>
		<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="assets/js/opinion.js"></script>
		<script type="text/javascript">
			var mixer = mixitup('#payment', {
				load: {
					filter: 'none'
				}
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
			$('select').material_select();
		  });
		</script>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".clickable-row").click(function() {
					window.location = $(this).data("href");
				});
			});
		</script>