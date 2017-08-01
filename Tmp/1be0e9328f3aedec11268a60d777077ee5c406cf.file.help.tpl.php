<?php /* Smarty version Smarty-3.1.21-dev, created on 2014-12-03 20:43:10
         compiled from "/var/www/registryfrm/App/View/Help/help.tpl" */ ?>
<?php /*%%SmartyHeaderCode:178997177853efc0dfbe5319-60244355%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1be0e9328f3aedec11268a60d777077ee5c406cf' => 
    array (
      0 => '/var/www/registryfrm/App/View/Help/help.tpl',
      1 => 1417635511,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '178997177853efc0dfbe5319-60244355',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_53efc0dfc10300_61556067',
  'variables' => 
  array (
    'arg' => 0,
    'menu2' => 0,
    'p' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_53efc0dfc10300_61556067')) {function content_53efc0dfc10300_61556067($_smarty_tpl) {?><div id='left'>
	<h2>ted jsme v help template</h2>
	<?php echo $_smarty_tpl->tpl_vars['arg']->value;?>

</div>

<div id='right'>
	<h3>menu 2</h3>
	<?php  $_smarty_tpl->tpl_vars['p'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['p']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menu2']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['p']->key => $_smarty_tpl->tpl_vars['p']->value) {
$_smarty_tpl->tpl_vars['p']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['p']->key;
?>
		<a href='http://localhost/registryfrm/www/<?php echo $_smarty_tpl->tpl_vars['p']->value;?>
' ><?php echo $_smarty_tpl->tpl_vars['k']->value;?>
</a></br>
	<?php } ?>
</div><?php }} ?>
