		<script src="assets/js/sweetalert.min.js"></script>
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
		
		
		
						<h1 class="header center orange-text">{$CONFIG} {$plugin_name}</h1>
						
						<div style="margin: auto;" class="card-panel col s12 m12 l10">
			{if $updated != "" && $updated == "yes"}
						<div style="width: 50%; margin: auto;">
							<center style="border-bottom: 1px solid #4CAF50; box-shadow: 0 1px 0 0 #4CAF50;">{$UPDATED}</center>
						</div>
						<br />
			{/if}
			{if $notupdated != "" && $notupdated == "yes"}
						<div style="width: 50%; margin: auto;">
							<center style="border-bottom: 1px solid #9e9e9e;">{$NOTUPDATED}</center>
						</div>
						<br />
			{/if}
							<!-- /*<h5 class="header col s12 light">List of IPs</h5>
							<p class="hr2"></p> */ -->
							<center>{$ADDLIMIT}</center>
							<div style="width: 50%; margin: auto;">
								<p class="hrr"></p>
							</div>
							<form method="POST" action="servers.php?plugin={$plugin_id}" id="formValidate" class="formValidate col s12" style="margin: auto;">
							<div style="width: 50%; margin: auto;">
			{foreach from=$server_list item=server}
								<input type="text" name="service_id[]" value="{$server.ip}">
			{/foreach}
								<input type="text" name="service_id[]" value="">
								<input type="text" name="service_id[]" value="">
							</div>
								<center><button class="btn" type="submit" name="register" style="width: 250px;">{$UPDATE}<i class="material-icons right">keyboard_arrow_right</i></button></center>
							</form>
						</div>
						
						<div class="fixed-action-btn">
							<a href="user.php" class="btn-floating btn-large tooltipped" data-tooltip="{$BACK}" data-position="top" >
								<i class="large material-icons">keyboard_arrow_left</i>
							</a>
						</div>
		<!--Scripts Internal-->
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="assets/js/materialize.js"></script>
		<script src="assets/js/mixitup.min.js"></script>
		<script src="assets/js/ip.js"></script>
		<script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="assets/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="assets/js/ip.js"></script>
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