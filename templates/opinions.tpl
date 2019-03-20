		<div class="section no-pad-bot" id="index-banner">
			<div class="container">
				<h1 class="header center orange-text">{$OPINIONSABOUT}</h1>
				<div class="row center">
					<h5 class="header col s12 light">{$OPINIONSFROM}</h5>
				</div>
				<p class="hrr"></p>
{if $logoutbutton != "" && $alreadyopinion == ""}
				<form method="POST" action="opinions.php" id="formValidate" class="formValidate col s12" style="margin: auto; margin-top: 150px; margin-bottom: 150px;">
					<div style="width: 70%; margin: auto;">
						<center><input class="textwindow" type="text" name="opinion" /></center>
					</div>
					<br />
					<center><button class="btn" type="submit" name="register" style="width: 250px;">{$SUBMITOPINION}<i class="material-icons right">keyboard_arrow_right</i></button></center>
				</form>
				<p class="hrr"></p>
{/if}
				<div style="margin-bottom: 200px;">
{foreach from=$opinion_list item=opinionn}
					<div class="card-panel card-panel2">
						<span style="font-size: 12px;"><a href=\"http://steamcommunity.com/profiles/{$opinionn.steamnumber}" >{$opinionn.steamnumber}</a></span>
						<br /><br />{$opinionn.opinion}
					</div>
{/foreach}
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
		<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
		<script src="./assets/js/materialize.js"></script>
		<script src="./assets/js/mixitup.min.js"></script>
		<script src="./assets/js/opinion.js"></script>
		<script type="text/javascript" src="./assets/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="./assets/js/additional-methods.min.js"></script>
		<script type="text/javascript" src="./assets/js/opinion.js"></script>