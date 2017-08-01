<html>
<head>
	<title>framework </title>
	<link href="http://localhost/registryfrm/www/css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<h1>web site </h1>

	<div id='mainmenu'>
		<nav id='main'>
		{foreach from=$menu key=k item=p}
			<a href='http://localhost/registryfrm/www/{$p}' >{$k}</a>
		{/foreach}
		</nav>
	</div>

	<div id='container'>
			{include file="$tpl_name"}
		

	</div>

</body>
</html>