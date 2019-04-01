		<script src="assets/js/sweetalert.min.js"></script>
		<!--CSS Internal-->
		<style type="text/css">
			table.lolek tr.clickable-row:hover td {
				background-color: #1d1e1f;
			}
			.clickable-row {
				cursor: pointer; 
			}
			.input-field div.error {
				position: relative;
				top: -1rem;
				left: 0rem;
				font-size: 0.8rem;
				color:#FF4081;
				-webkit-transform: translateY(0%);
				-ms-transform: translateY(0%);
				-o-transform: translateY(0%);
				transform: translateY(0%);
			}
			.input-field label.active {
				width:100%;
			}
			.selection_server {
				padding: 0 !important;
			}
			.tabs {
				overflow-x: inherit;
				overflow-y: inherit;
				height: inherit;
				background-color: #1d1e1f;
			}
			.tabs .tab {
				display: block;
			}
			.tabs .indicator {
				display:none;
			}
			.left-alert input[type=text] + label:after, 
			.left-alert input[type=password] + label:after, 
			.left-alert input[type=sid] + label:after, 
			.right-alert input[type=text] + label:after, 
			.right-alert input[type=password] + label:after, 
			.right-alert input[type=sid] + label:after, 
			
			.errorTxt6 {
				margin-top: 30px;
				margin-left: 10px;
			}
		</style>
		
		<div id="payment" style="width: 100%;" class="service card-panel col s12 m12 l10">
			<table style="width:100%">
				<tr>
				<td class="width19" style="vertical-align: top;">
					{$PANEL}
					<p class="hrr"></p>
					<div class="control2s">
						<button type="button" class="control2" data-filter=".YOURLICENSES">{$YOURLICENSES}</button>
						<button type="button" class="control2" data-filter=".HELPDESK">{$HELPDESK}{if $UNSEEN > 0} ({$UNSEEN} {$NEW}){/if}</button>
					</div>
					
{if $sendticket == "1"}
					<center style="border-bottom: 1px solid #4CAF50; box-shadow: 0 1px 0 0 #4CAF50;">{$TICKETSEND}</center>
					<br />
{/if}
				</td>
				<td class="width79" style="vertical-align: top;">
					<div style="width: 100%" class="mix YOURLICENSES">
						<h1 class="header center orange-text">{$YOURLICENSES}</h1>
						<div style="margin: auto;" class="card-panel col s12 m12 l10">
{if $plugin_list != ""}
							<center>{$CLICKIP}</center>
							<div style="width: 50%; margin: auto;">
								<p class="hrr"></p>
							</div>
							<br />
							
	{foreach from=$plugin_list item=plugin}
							<form method="POST" action="servers.php?plugin={$plugin.plugin_id}" id="formValidate" class="formValidate col s12" style="margin: auto;">
								<center><button class='btn-flat' type="submit" name="register" style="width: 250px;">{$plugin.plugin_name}<i class="material-icons right">keyboard_arrow_right</i></button></center>
							</form>
							<br />
							<form method="POST" action="{$plugin.plugin_dl}" id="formValidate" class="formValidate col s12" style="margin: auto;"  target="_blank">
								<center><button class='btn-flat' type="submit" name="register" style="width: 250px;">{$DOWNLOAD}<i class="material-icons right">file_download</i></button></center>
							</form>
							<br />
							<br />
							<br />
							<br />
							<br />
							<br />
	{/foreach}
{else}
							<center>{$NOLICENSES}</center>
							<p class="hrr"></p>
							<br />
							<br />
							<div class="center"><a href="/buy.php" class="btn-flat">{$BUYSOME}</a></div>
{/if}
						</div>
					</div>
					<div style="width: 100%" class="mix HELPDESK">
						<h1 class="header center orange-text">{$HELPDESK}</h1>
						<div style="margin: auto;" class="card-panel col s12 m12 l10">
							<center>{$HOWCANWEHELP}</center>
							<div style="width: 100%; margin: auto;">
								<p class="hrr"></p>
							</div>
							<br />
{if $ticket_list == ""}
							<center>{$NOTICKETS}</center>
							<br />
{/if}
							<div class="center"><a class="btn-flat" data-filter=".HELPDESKWRITE">{$WRITEATICKET}</a></div><br />
{if $ticket_list != ""}
							<div style="width: 80%; margin: auto;">
								<div class="center"><table class="lolek">
									<tr>
										<td>{$ID}</td>
										<td>{$TEXT}</td>
										<td>{$WRITTEN}</td>
										<td>{$STATUS}</td>
									</tr>
	{foreach from=$ticket_list item=ticket}
									<tr class="clickable-row" data-href="ticket.php?id={$ticket.ticketid}">
										<td>#{$ticket.ticketid}</td>
										<td>{$ticket.text}</td>
										<td>{$ticket.time}</td>
		{if $ticket.seen == "1"}
										<td><span class="tooltipped" data-tooltip="{$SEEN}" data-position="top" ><i class="material-icons">check_circle</i></span></td>
		{else}
										<td><span class="tooltipped" data-tooltip="{$PENDING}" data-position="top" ><i class="material-icons">access_time</i></span></td>
		{/if}
									</tr>
	{/foreach}
								</table></div>
							</div>
{/if}
						</div>
					</div>
					<div style="width: 100%" class="mix HELPDESKWRITE">
						<h1 class="header center orange-text">{$WRITEATICKET}</h1>
						<div style="margin: auto;" class="card-panel col s12 m12 l10">
							<center>{$TELLUSWHATSWRONG}</center>
							<br />
							<br />
							<br />
							<form method="POST" action="user.php" id="formValidate" class="formValidate col s12" style="margin: auto;">
								<div style="width: 70%; margin: auto;">
									<center><input type="text" name="textofticket" style="width: 100%; height: 200px; white-space: pre-wrap; border-left: 2px solid #A6885E; border-right: 2px solid #A6885E;"/></center>
								</div>
								<br />
								<center><button class="btn" type="submit" name="register" style="width: 250px;">{$SEND}<i class="material-icons right">keyboard_arrow_right</i></button></center>
							</form>
						</div>
						
						<div class="fixed-action-btn">
							<a class="btn-floating btn-large tooltipped" data-tooltip="{$BACK}" data-position="top" data-filter=".HELPDESK">
								<i class="large material-icons">keyboard_arrow_left</i>
							</a>
						</div>
					</div>
				</td>
				</tr>
			</table>
			<br />
		</div>
		<!--Scripts Internal-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="assets/js/materialize.js"></script>
		<script src="assets/js/mixitup.min.js"></script>
		<script src="assets/js/user.js"></script>
		<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="assets/js/user.js"></script>
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