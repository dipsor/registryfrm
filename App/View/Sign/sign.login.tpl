<div id='left'>
	<h2>ted jsme v Log Im template</h2>
	<h3>Log In</h3>
	{foreach from=$signupmenu key=k item=p}
		<a href='http://localhost/registryfrm/www/sign/{$p}' >{$k}</a></br>
	{/foreach}
	<br>

	{if isset( $form ) }
		{$form}
	{/if}
</div>