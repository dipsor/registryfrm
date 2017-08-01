<?php /* Smarty version Smarty-3.1.21-dev, created on 2015-08-11 16:41:22
         compiled from "C:\xampp\htdocs\registryfrm\App\View\Help\help.default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2928655c9de9fcb55c3-50932587%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b74cfbb48ade1c149f8a112dc86a595f5e93fb19' => 
    array (
      0 => 'C:\\xampp\\htdocs\\registryfrm\\App\\View\\Help\\help.default.tpl',
      1 => 1439304077,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2928655c9de9fcb55c3-50932587',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_55c9de9fcd48d3_66738107',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c9de9fcd48d3_66738107')) {function content_55c9de9fcd48d3_66738107($_smarty_tpl) {?><div id='left'>
	<h2>ted jsme v help template</h2>
	
	<h3>vypis relaci</h3>
	<form action="http://localhost/registryfrm/www/help/sessions" method="post">
	<input type="submit" value="zjisti relace">
	</form>
	<form action="http://localhost/registryfrm/www/help/deleteSession" method="post">
	<input type="submit" value="smaz relaci">
	</form>
	<br>


</div><?php }} ?>
