<div id='left'>
	<h2>ted jsme v homepage template</h2>
	<h3>menu 2</h3>
	{foreach from=$menu2 key=k item=p}
		<a href='http://localhost/registryfrm/www/{$p}' >{$k}</a></br>
	{/foreach}
	<br>
	<h3> Form na secteni </h3>
	<form action="http://localhost/registryfrm/www/homepage/secti" method="post">
	promenna A: <input type="text" name="a"><br>
	promenna B: <input type="text" name="b"><br>
	<input type="submit">
	</form>

	{if isset ($secti) }
		vysledek: 
		{$secti} .
	{/if}

</div>