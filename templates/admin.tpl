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
						<button type="button" class="control2" data-filter=".ADDLIC">{$ADDLIC}</button>
						<button type="button" class="control2" data-filter=".VIEWLIC">{$VIEWLIC}</button>
						<button type="button" class="control2" data-filter=".ADDPLUG">{$ADDPLUG}</button>
						<button type="button" class="control2" data-filter=".EDITPLUG">{$EDITPLUG}</button>
						<button type="button" class="control2" data-filter=".HELPDESK">{$HELPDESK}</button>
					</div>
					<br />
		{if $addplugnoname == "1"}
					<center style="border-bottom: 1px solid #9e9e9e;">{$NAMETAKEN}</center>
					<br />
		{/if}
		{if $addplugsucc == "1"}
					<center style="border-bottom: 1px solid #4CAF50; box-shadow: 0 1px 0 0 #4CAF50;">{$PLUGADDED}</center>
					<br />
		{/if}
		{if $addplugfail == "1"}
					<center style="border-bottom: 1px solid #9e9e9e;">{$FAILEDADDPLUG}</center>
					<br />
		{/if}
		{if $deletelicenseinfo != "" && $deletelicenseinfo == "1"}
					<center style="border-bottom: 1px solid #4CAF50; box-shadow: 0 1px 0 0 #4CAF50;">{$DELLICENCESUCC}</center>
					<br />
		{/if}
		{if $deletelicenseinfo != "" && $deletelicenseinfo == "0"}
					<center style="border-bottom: 1px solid #9e9e9e;">{$DELLICENCEFAIL}</center>
					<br />
		{/if}
		{if $licenseinfo != "" && $licenseinfo == "1"}
					<center style="border-bottom: 1px solid #4CAF50; box-shadow: 0 1px 0 0 #4CAF50;">{$SUCCESLIC}</center>
					<br />
		{/if}
		{if $licenseinfo != "" && $licenseinfo == "0"}
					<center style="border-bottom: 1px solid #9e9e9e;">{$FAILLIC}</center>
					<br />
		{/if}
		{if $updatepluginfo != "" && $updatepluginfo == "1"}
					<center style="border-bottom: 1px solid #4CAF50; box-shadow: 0 1px 0 0 #4CAF50;">{$INFOSUCCEDIT}</center>
					<br />
		{/if}
		{if $updatepluginfo != "" && $updatepluginfo == "0"}
					<center style="border-bottom: 1px solid #9e9e9e;">{$INFOFAILEDIT}</center>
					<br />
		{/if}
				</td>
				<td class="width79" style="vertical-align: top;">
					<div style="width: 100%" class="mix ADDLIC">
						<h1 class="header center">{$ADDLIC}</h1>
						<p class="hrr"></p>
						<br /><br />
						
						<div style="width: 50%; margin: auto;" class="card-panel col s12 m12 l10">
							<form method="POST" action="admin.php" id="formValidate" class="formValidate col" style="margin: auto;">
								<input type="text" name="formsteamid" value="STEAM_">
								<select name="formpluginid">
			{foreach from=$plugin_list item=plugin}
									<option label="{$plugin.name}" value="{$plugin.id}">{$plugin.name}</option>
			{/foreach}
								</select>
								<button class="btn" type="submit" name="register">{$ADD}<i class="material-icons right">add</i></button>
							</form>
							
							<br /><br />
							
						</div>
					</div>
					
					<div style="width: 100%" class="mix VIEWLIC">
						<h1 class="header center">{$VIEWLIC}</h1>
						<p class="hrr"></p>
						<br /><br />
						
			
			{foreach from=$pluginusers_list item=pluginusers}
						<div style="width: 50%; margin: auto;" class="card-panel col s12 m12 l10">
							<br />
							<button class="control2" style="cursor: default;">{$pluginusers.name}</button>
							<br />
				{foreach from=$pluginusers.users item=user}
							<div class="center">
								<form method="POST" action="admin.php" id="formValidate" class="formValidate col" style="margin: auto;">
									<input type="hidden" name="formdeleteuserid" value="{$user.id}">
									<input type="hidden" name="formdeletesteamid" value="{$user.steamid}">
									<input type="hidden" name="formdeletepluginid" value="{$pluginusers.id}">
									{$user.steamid}<br /><button class="btn" type="submit" name="register" style="width: 100px;">{$DEL}<i class="material-icons">delete</i></button>
								</form>
							</div>
							<br /><br /><br />
				{/foreach}
						</div>
						<p class="hrr"></p>
			{/foreach}
					</div>
					
					<div style="width: 100%" class="mix ADDPLUG">
						<h1 class="header center">{$ADDPLUG}</h1>
						<p class="hrr"></p>
						<br /><br />
						
						<div style="width: 50%; margin: auto;" class="card-panel col s12 m12 l10">
							<form method="POST" action="admin.php" id="formValidate2" class="formValidate col" style="margin: auto;">
								<div style="margin: auto;">
									<center><span class="orange-text">{$AUTHOR}:</span></center>
									<select name="formauthorid">
			{foreach from=$author_list item=author}
										<option label="{$author.name}" value="{$author.id}">{$author.name}</option>
			{/foreach}
									</select>
									<center><span class="orange-text">{$THENAME}:</span></center>
									<input type="text" name="formname" value="">
									<center><span class="orange-text">{$UQSHORT}:</span></center>
									<input type="text" name="formuniqueshort" value="">
									<!-- /* <center><span class="orange-text">Select File:</span></center>
									<input type="file" name="fileToUpload" id="fileToUpload"> */ -->
									<br /><br /><br />
								</div>
								<button class="btn" type="submit" name="register">{$ADD}<i class="material-icons right">add</i></button>
							</form>
							
							<br /><br />
							
						</div>
					</div>
					
					<div style="width: 100%" class="mix EDITPLUG">
						<h1 class="header center">{$EDITPLUG}</h1>
						<p class="hrr"></p>
						<br /><br />
						
			{foreach from=$plugins_list item=plugin}
						<div style="width: 50%; margin: auto;" class="card-panel col s12 m12 l10">
							<br />
							<center><h5 class="header col s12 light">{$plugin.name}</h5></center>
							<br />
							<div style="width: 50%; margin: auto;" class="card-panel col s12 m12 l10">
								<button class="control2" style="cursor: default;">ID: {$plugin.id}</button>
							</div>
							<br />
							<form method="POST" action="admin.php" id="formValidate" class="formValidate col s12" style="margin: auto;">
								<input type="hidden" name="updateformid" value="{$plugin.id}">
								<div style="width: 50%; margin: auto;">
									<center><span class="orange-text">{$THENAME}:</span></center>
									<input type="text" name="updateformname" value="{$plugin.name}">
									<center><span class="orange-text">{$PRICE}:</span></center>
									<input type="text" name="updateformprice" value="{$plugin.price}">
									<center><span class="orange-text">{$URL}:</span></center>
									<input type="text" name="updateformlink" value="{$plugin.link}">
									<center><span class="orange-text">{$DESC}:</span></center>
									<input type="text" name="updateformdesc" value='{$plugin.desc}'>
									<center><span class="orange-text">{$DESCPL}:</span></center>
									<input type="text" name="updateformdescpl" value='{$plugin.descpl}'>
								</div>
								<center><button class="btn" type="submit" name="register" style="width: 250px;">{$UPDATE} Update<i class="material-icons right">cached</i></button></center>
							</form>
						</div>
						<br />
						<br />
						<p class="hrr"></p>
			{/foreach}
							
						<br /><br />
							
					</div>
					
					<div style="width: 100%" class="mix HELPDESK">
						<h1 class="header center">{$HELPDESK}</h1>
						<p class="hrr"></p>
						<br /><br />
						
						<div style="width: 80%; margin: auto;" class="card-panel col s12 m12 l10">
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
							<br /><br />
							
						</div>
					</div>
					
				</td>
				</tr>
			</table>
		</div>
		
		<!--Scripts Internal-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="assets/js/materialize.js"></script>
		<script src="assets/js/mixitup.min.js"></script>
		<script src="assets/js/steam.js"></script>
		<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="assets/js/steam.js"></script>
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