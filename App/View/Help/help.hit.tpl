<div id='left'>
	<h2>ted jsme v help template</h2>
	
	<h3>menu 2</h3>
	{foreach from=$menu2 key=k item=p}
		<a href='http://localhost/registryfrm/www/{$p}' >{$k}</a></br>
	{/foreach}
	<br>
	vystup metody <strong>test</strong> - {$arg}	

</div>