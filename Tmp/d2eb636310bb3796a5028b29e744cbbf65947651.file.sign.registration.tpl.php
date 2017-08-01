<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-03-09 22:27:46
         compiled from "C:\xampp\htdocs\registryfrm\App\View\Sign\sign.registration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2034456e09552972d74-98648464%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2eb636310bb3796a5028b29e744cbbf65947651' => 
    array (
      0 => 'C:\\xampp\\htdocs\\registryfrm\\App\\View\\Sign\\sign.registration.tpl',
      1 => 1417724583,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2034456e09552972d74-98648464',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'signupmenu' => 0,
    'p' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_56e09552a681b0_06116878',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_56e09552a681b0_06116878')) {function content_56e09552a681b0_06116878($_smarty_tpl) {?><div id='left'>
	<h2>ted jsme v Registration template</h2>
	<h3>Registrace </h3>
	<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['signupmenu']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
		<a href='http://localhost/registryfrm/www/sign/<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
' ><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a></br>
	<?php } ?>
	<br>
</div><?php }} ?>
