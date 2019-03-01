		<div class="section no-pad-bot" id="index-banner">
			<div class="container">
				<h1 class="header center orange-text">{$YALIKE}</h1>
				<div class="row center">
					<h5 class="header col s12 light">{$CONTACTUS}</h5>
				</div>

	{foreach from=$author_list item=author}
				- <a href="{$author.link}" target="_blank">{$author.name}</a><br /><br />
	{/foreach}
				
				<p class="hrr"></p><br />
				
				<div class="row center">
					<h5 class="header col s12 light">{$WHYUS}</h5>
				</div>
				
				{$WHYUS1}<br />
				{$WHYUS2}<br />
				{$WHYUS3}<br />
				{$WHYUS4}<br /><br />
				
				<p class="hrr"></p><br />
				
				<div class="row center">
					<h5 class="header col s12 light">{$MORE}</h5>
				</div>
				<br />
				{$MOREPLUGINS}
				
				<br /><br />
			</div>
		</div>