		<div class="section no-pad-bot" id="index-banner" style="margin-top: 3em;">
			<div class="container">
				<img src="./assets/images/logov2nr3.png" style="width: 55%; display: block; margin: auto;"/>
				<h1 class="header center orange-text">{$TITLEPLUGINS}</h1>
				<div class="row center">
					<h5 class="header col s12 light">{$TITLESMALL}</h5>
				</div>
				<div class="row center">
{if $login_button_main == "1"}
					<a href='?login'><img src='./assets/images/steamloginv2.png'></a>
{else}
					<a href="/plugins.php"><span class="btn-flat">{$LOOKAROUND}</span></a>
{/if}
				</div>
			</div>
		</div>