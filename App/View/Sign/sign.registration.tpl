<div id='left'>
	<h2>ted jsme v Registration template</h2>
	<h3>Registrace </h3>
	{foreach from=$signupmenu key=k item=p}
		<a href='http://localhost/registryfrm/www/sign/{$p}' >{$k}</a></br>
	{/foreach}
	<br>
</div>