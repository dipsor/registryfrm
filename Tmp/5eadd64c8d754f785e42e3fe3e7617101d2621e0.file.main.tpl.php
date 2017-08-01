<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-11 13:37:52
         compiled from "C:\xampp\htdocs\registryfrm\App\View\main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2759555c9de90462189-61239034%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5eadd64c8d754f785e42e3fe3e7617101d2621e0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\registryfrm\\App\\View\\main.tpl',
      1 => 1417892013,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2759555c9de90462189-61239034',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'menu' => 0,
    'p' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c9de90662330_97060867',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c9de90662330_97060867')) {function content_55c9de90662330_97060867($_smarty_tpl) {?><html>
<head>
	<title>framework </title>
	<link href="http://localhost/registryfrm/www/css/style.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
	<h1>web site </h1>

	<div id='mainmenu'>
		<nav id='main'>
		<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
			<a href='http://localhost/registryfrm/www/<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
' ><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a>
		<?php } ?>
		</nav>
	</div>

	<div id='container'>
			<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_name']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		

	</div>

</body>
</html><?php }} ?>
