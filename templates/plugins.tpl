		<script src="./assets/js/sweetalert.min.js"></script>
		<!--CSS Internal-->
		<style type="text/css">
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
		
		<div class="section" id="index-banner">
			<div class="container" style="width: 100%;">
			
				<h1 class="header center orange-text">{$PLUGINS}</h1>
				<div class="row center">
					<h5 class="header col s12 light">{$PLUGINS2}</h5>
				</div>
				
				<!-- /* <div class="row" style="margin-bottom: 20px;">
					<ul class="tabs tabs-fixed-width" style="width: 96%;">
						<li class="tab col s12"><a href="#paid">!Paid</a></li>
						<li class="tab col s12"><a href="#free">{$FREE}</a></li>
						<li class="tab col s12"><a href="#beta">BETA</a></li>
					</ul>
				</div> */ -->
				<div id="payment" style="width: 100%;" class="service card-panel col s12 m12 l10">
					<table style="width:100%">
						<tr>
							<td class="width19" style="vertical-align: top;">
								{$LIST}
								<p class="hrr"></p>
								<div class="controls">
		{foreach from=$plugin_list item=plugin}
									<button type="button" class="control" data-filter=".{$plugin.short_name}">{$plugin.name} {if $plugin.price == "0"}({$FREE}){/if}</button>
		{/foreach}
								</div>
							</td>
							<td class="width79" style="vertical-align: top;">
		{foreach from=$plugin_list item=plugin}
								<div style="width: 100%" class="mix {$plugin.short_name}">
									<h1 class="header center">{$plugin.name}</h1>
									<p class="hrr"></p>
									<br /><br />
									
									<h5 class="header col s12 light">{$AUTHOR}</h5>
									<p class="hr2"></p>
									{$plugin.author_name} - <a href="{$plugin.author_sid}" target="_blank">{$CONTACT}</a>
									<br /><br /><br /><br />
		{if $plugin.desc != ""}
									<h5 class="header col s12 light">{$DESC}</h5>
									<p class="hr2"></p>
									{$plugin.desc}
									<br /><br /><br /><br />
		{/if}
		{if $plugin.price > 0}
									<h5 class="header col s12 light">{$PRICE}</h5>
									<p class="hr2"></p>
									{$plugin.price_euro}€ / {$plugin.price_dolar}$ / {$plugin.price}PLN
									<br /><br /><br /><br />
		{elseif $plugin.price == -1}
									<h5 class="header col s12 light">{$DISCLAMER}</h5>
									<p class="hr2"></p>
									{$DISCLAMERDESC}
									<br /><br /><br /><br />
		{/if}
<!-- tutaj jeśli zalogowany -->
		{if $plugin.price > 0}
			{if $logoutbutton != ""}
				{if $plugin.hasthisplugin == "1"}
										<a href="/servers.php?plugin={$plugin.id}" style="float: right; margin-bottom: 50px;"><span class="btn ">{$EDITSERV} <i class="material-icons right">keyboard_arrow_right</i></span></a>
					{if $plugin.link != ""}
										<a href="{$plugin.link}" target="_blank"><span class="btn ">{$DOWNLOAD} <i class="material-icons right">file_download</i></span></a>
					{else}
										<a href="#"><span class="btn" style="margin-bottom: 50px;">{$NODOWNLOAD}</span></a>
					{/if}
				{else}
										<a href="/buy.php" style="float: right; margin-bottom: 50px;"><span class="btn ">{$BUY} <i class="material-icons right">keyboard_arrow_right</i></span></a>
				{/if}
			{/if}
			{if $logoutbutton == ""}
										<a href="/buy.php" style="float: right; margin-bottom: 50px;"><span class="btn ">{$BUY} <i class="material-icons right">keyboard_arrow_right</i></span></a>
			{/if}
		{else}
			{if $logoutbutton != ""}
				{if $plugin.link != ""}
										<a href="{$plugin.link}" target="_blank" style="float: right;  margin-bottom: 50px;"><span class="btn ">{$DOWNLOAD} <i class="material-icons right">file_download</i></span></a>
				{else}
										<a href="#"><span class="btn" style="float: right;  margin-bottom: 50px;">{$NODOWNLOAD}</span></a>
				{/if}						
			{else}
										<a href="?login" style="float: right; margin-bottom: 50px;"><span class="btn ">{$LOGINDOWNLOAD}</span></a>
			{/if}
		{/if}
	
<!-- tutaj jeśli zalogowany -->
	
								</div>
		{/foreach}
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
						
		<!--Scripts Internal-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="./assets/js/materialize.js"></script>
		<script src="./assets/js/mixitup.min.js"></script>
		<script src="./assets/js/plugins.js"></script>
		<script type="text/javascript" src="./assets/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="./assets/js/additional-methods.min.js"></script>
		<script type="text/javascript">
			var mixer2 = mixitup('#payment', {
				load: {
					filter: 'none' // Ensure that the mixer's initial filter matches the URL on startup
				}
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function() {
			$('select').material_select();
		  });
		</script>